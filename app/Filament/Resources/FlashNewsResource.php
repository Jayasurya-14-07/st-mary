<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlashNewsResource\Pages;
use App\Models\FlashNews;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;

class FlashNewsResource extends Resource
{
    protected static ?string $model = FlashNews::class;

    protected static ?string $navigationLabel = 'Notices';
    protected static ?string $modelLabel = 'Notice';
    protected static ?string $pluralModelLabel = 'Notices';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';
    protected static string|\UnitEnum|null $navigationGroup = 'CMS';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make("title")
                    ->label("Title")
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('slug', Str::slug($state));
                    })
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->readOnly(),

                Forms\Components\TextInput::make('link')
                    ->url()
                    ->maxLength(255),
                Toggle::make('open_in_new_tab')
                    ->label('Open in new tab')
                    ->default(false),

                Forms\Components\Toggle::make('status')
                    ->required()
                    ->default(true),
                Forms\Components\DatePicker::make('publish_date')
                    ->required()
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('status'),
                Tables\Columns\TextColumn::make('publish_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
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
            'index' => Pages\ListFlashNews::route('/'),
            'create' => Pages\CreateFlashNews::route('/create'),
            'edit' => Pages\EditFlashNews::route('/{record}/edit'),
        ];
    }
}
