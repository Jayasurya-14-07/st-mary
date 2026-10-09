<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoGalleryResource\Pages;
use App\Models\VideoGallery;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class VideoGalleryResource extends Resource
{
    protected static ?string $model = VideoGallery::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-video-camera';
    protected static string|\UnitEnum|null $navigationGroup = 'Gallery';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter sample title'),
                Forms\Components\Repeater::make('link')
                    ->components([
                        Forms\Components\TextInput::make('url')
                            ->url()
                            ->required()
                            ->placeholder('Enter a link'),
                    ])
                    ->addable()
                    ->deletable()
                    ->reorderable()
                    ->columnSpanFull()
                    ->minItems(1),
                            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->formatStateUsing(fn ($state) => is_array($state)
                        ? collect($state)->map(function ($item) {
                            $url = is_array($item) ? ($item['url'] ?? '') : $item;
                            return "<a href='{$url}' target='_blank' style='color: #292962; text-decoration: underline;'>{$url}</a>";
                        })->implode('<br>')
                        : $state
                    )
                    ->html()
                    ->limit(100)
                    ->tooltip('Click to open link')
                    ->copyable(),

              
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
                    ViewAction::make(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideoGalleries::route('/'),
            'create' => Pages\CreateVideoGallery::route('/create'),
            'edit' => Pages\EditVideoGallery::route('/{record}/edit'),
        ];
    }
}
