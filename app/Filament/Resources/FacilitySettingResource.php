<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilitySettingResource\Pages;
use App\Filament\Resources\FacilitySettingResource\RelationManagers;
use App\Models\FacilitySetting;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;

class FacilitySettingResource extends Resource
{
    protected static ?string $model = FacilitySetting::class;

    protected static ?string $navigationLabel = 'Facilities';
    protected static ?string $modelLabel = 'Facilities Section';
    protected static ?string $pluralModelLabel = 'Facilities Section';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';
    protected static string|\UnitEnum|null $navigationGroup = 'Sections';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kicker')
                    ->label('Kicker / Category Tag')
                    ->default('Facilities')
                    ->required(),

                TextInput::make('title')
                    ->label('Section Main Heading')
                    ->default('Facilities for Learning and Growth.')
                    ->required(),

                Textarea::make('excerpt')
                    ->label('Section Summary / Excerpt')
                    ->default('St. Mary’s Convent School provides a safe, welcoming, and child-friendly learning environment with facilities that support the academic, physical, creative, and overall development of our students. The school continually strives to provide the resources and opportunities needed to make learning meaningful, engaging, and enjoyable.')
                    ->rows(4)
                    ->required(),

                FileUpload::make('images')
                    ->label('Homepage Section Grid Images (Must upload exactly 4 images)')
                    ->helperText('Drag to reorder. Image 1: top-left (col-7), Image 2: top-right (col-5), Image 3: bottom-left (col-5), Image 4: bottom-right (col-7).')
                    ->multiple()
                    ->minFiles(4)
                    ->maxFiles(4)
                    ->reorderable()
                    ->directory('facilities-grid')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kicker'),
                Tables\Columns\TextColumn::make('title')
                    ->limit(40),
                Tables\Columns\TextColumn::make('excerpt')
                    ->limit(60),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FacilitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFacilitySettings::route('/'),
            'edit' => Pages\EditFacilitySetting::route('/{record}/edit'),
        ];
    }
}
