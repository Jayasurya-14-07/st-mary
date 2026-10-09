<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use Awcodes\Curator\Models\Media;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Awcodes\Curator\Components\Tables\CuratorColumn;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static string|\UnitEnum|null $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    protected static ?string $pluralLabel = 'Media';

    protected static ?string $slug = 'media';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('Media Metadata')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->placeholder('Enter image title')
                            ->maxLength(255),
                        TextInput::make('alt')
                            ->label('Alt Text')
                            ->placeholder('Enter alternative text for accessibility')
                            ->maxLength(255),
                        Textarea::make('caption')
                            ->label('Caption')
                            ->rows(2),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('path')
                    ->label('Preview')
                    ->size(150),
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('name')
                    ->label('File Name')
                    ->searchable()
                    ->sortable()
                    ->size('xs'),
                TextColumn::make('size')
                    ->label('Size')
                    ->formatStateUsing(fn($state) => number_format($state / 1024, 2) . ' KB')
                    ->size('xs'),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 4,
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil-square'),
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => \Awcodes\Curator\Resources\Media\Pages\ListMedia::route('/'),
            'create' => \Awcodes\Curator\Resources\Media\Pages\CreateMedia::route('/create'),
            'edit' => \Awcodes\Curator\Resources\Media\Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
