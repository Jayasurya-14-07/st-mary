<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoGalleryResource\Pages;
use App\Models\PhotoGallery;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class PhotoGalleryResource extends Resource
{
    protected static ?string $model = PhotoGallery::class;
    protected static string $icon = 'heroicon-o-photo';
    protected static string|\UnitEnum|null $navigationGroup = 'Gallery';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
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
                            ->readOnly(),

                        Forms\Components\Textarea::make("description")
                            ->label("Description")
                            ->maxLength(255)
                            ->required()
                            ->rows(5),

                        Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->required(),
                                Forms\Components\DatePicker::make('publish_date')
                                    ->label('Academic Year')
                                    ->default(now()),
                            ]),
                        Forms\Components\TextInput::make('order_by')
                            ->numeric()
                            ->default(null),
                    ])
                    ->columnSpanFull(),

                Section::make('Add Media')
                    ->description('Upload or select multiple images for the gallery.')
                    ->schema([
                        CuratorPicker::make('images')
                            ->label('Gallery Images')
                            ->relationship('images', 'name')
                            ->extraFieldWrapperAttributes(['class' => 'photo-gallery-images-picker'])
                            ->preserveFilenames()
                            ->directory(function (CuratorPicker $component) {
                                $year = now()->format('Y');
                                $slug = $component->getLivewire()->data['slug'] ?? 'default';
                                return 'file-manager/photo_gallery/' . $year . '/' . $slug;
                            })
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(3072)
                            ->multiple()
                            ->listDisplay(false)
                            ->columnSpanFull()
                            ->hint('Drag and drop multiple images to upload in bulk.')
                            ->required(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),
                CuratorColumn::make('images')
                    ->size(40)
                    ->overlap(4)
                    ->limit(3),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('publish_date')
                    ->label('Academic Year')
                    ->date()
                    ->sortable()
                    ->searchable(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhotoGalleries::route('/'),
            'create' => Pages\CreatePhotoGallery::route('/create'),
            'edit' => Pages\EditPhotoGallery::route('/{record}/edit'),
        ];
    }
}
