<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenusResource\Pages;
use App\Models\Menus;
use Filament\Forms;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;

class MenusResource extends Resource
{
    protected static ?string $model = Menus::class;
    protected static string $icon = 'heroicon-o-bars-3';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bars-3';
    protected static ?string $label = 'Menus';
    protected static ?string $navigationLabel = 'Menus';
    protected static string|\UnitEnum|null $navigationGroup = 'CMS';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make("name")
                    ->label("Name")
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('type')
                    ->options(Menus::TYPE_LABELS)
                    ->native(false)
                    ->required()
                    ->reactive(),

                Forms\Components\Checkbox::make('is_url')
                    ->live(),

                Forms\Components\TextInput::make('url')
                    ->hidden(fn(Get $get): bool => !$get('is_url'))
                    ->required(),

                Forms\Components\Select::make('target')
                    ->hidden(fn(Get $get): bool => !$get('is_url'))
                    ->label('Link Target')
                    ->live()
                    ->options([
                        '_self' => 'Same Tab',
                        '_blank' => 'New Tab',
                    ])
                    ->native(false),

                // Parent Menu selection
                Forms\Components\Select::make('parent_id')
                    ->label(fn(Get $get) => $get('type') === 'main_menu' ? 'Parent Menu' : 'Select Parent Menu')
                    ->relationship('parent', 'name', function (Builder $query, Get $get) {
                        $parentType = Menus::PARENT_TYPES[$get('type')] ?? null;

                        if (! $parentType) {
                            return $query->whereRaw('1 = 0');
                        }

                        return $query->where('type', $parentType)->where('status', 1);
                    })
                    ->searchable()
                    ->preload()
                    ->hidden(fn(Get $get) => !array_key_exists($get('type'), Menus::PARENT_TYPES))
                    ->required(fn(Get $get) => array_key_exists($get('type'), Menus::PARENT_TYPES))
                    ->native(false),

                Forms\Components\TextInput::make('order_by')
                    ->label('Place Number')
                    ->numeric()
                    ->default(null),

                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Group::make('parent.name')
                    ->collapsible(),
            ])
            ->reorderable('order_by')
            ->defaultGroup('parent.name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(fn(?string $state): string => Menus::TYPE_LABELS[$state] ?? ucfirst(str_replace('_', ' ', $state ?? '')))
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                TextInputColumn::make('order_by')
                    ->label('Place Number')
                    ->sortable()
                    ->type('number')
                    ->rules(['numeric', 'nullable']),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort(fn (Builder $query): Builder => $query
                ->orderByRaw('order_by IS NULL')
                ->orderBy('order_by', 'asc')
                ->orderBy('id', 'asc'))
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->before(function ($action, $record) {
                            try {
                                // Check if the menu has submenus
                                if ($record->children()->count() > 0) {
                                    throw new \Exception("This menu has submenus and cannot be deleted.");
                                }

                                // Check if the menu is referenced by a page
                                if ($record->page()->exists()) {
                                    throw new \Exception("This menu is referenced by a page and cannot be deleted.");
                                }

                            } catch (\Exception $e) {
                                // Show error notification and prevent deletion
                                Notification::make()
                                    ->title('Error')
                                    ->body($e->getMessage())
                                    ->danger()
                                    ->send();

                                // Prevent the deletion from proceeding
                                $action->cancel();
                            }
                        }),

                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuses::route('/'),
            'create' => Pages\CreateMenus::route('/create'),
            'edit' => Pages\EditMenus::route('/{record}/edit'),
        ];
    }
}
