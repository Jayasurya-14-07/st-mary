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
    protected static string|\UnitEnum|null $navigationGroup = 'Galleries';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter Video Title'),
                Forms\Components\TextInput::make('link')
                    ->label('YouTube Video Link / URL')
                    ->url()
                    ->required()
                    ->placeholder('https://youtu.be/wnHW6o8WMas')
                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state[0]['url'] ?? $state['url'] ?? json_encode($state)) : $state),
                Forms\Components\DatePicker::make('publish_date')
                    ->label('Publish Date')
                    ->default(now())
                    ->required(),
                Forms\Components\TextInput::make('order_by')
                    ->numeric()
                    ->default(0)
                    ->label('Order'),
                Forms\Components\Toggle::make('status')
                    ->label('Published')
                    ->default(true),
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
                    ->label('YouTube Link')
                    ->formatStateUsing(function ($state) {
                        $url = is_array($state)
                            ? ($state[0]['url'] ?? $state['url'] ?? json_encode($state))
                            : $state;
                        return "<a href='{$url}' target='_blank' style='color: #292962; text-decoration: underline;'>{$url}</a>";
                    })
                    ->html()
                    ->limit(60)
                    ->copyable(),
                Tables\Columns\TextColumn::make('publish_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status'),
                Tables\Columns\TextColumn::make('order_by')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order_by', 'asc')
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
