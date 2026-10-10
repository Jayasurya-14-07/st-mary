<?php

namespace App\Filament\Resources\FacilitySettingResource\RelationManagers;

use App\Filament\Shared\ContentBlocks;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Str;

class FacilitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'facilities';

    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $title = 'Facilities';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Facility Title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, Get $get, ?string $state) {
                        if (blank($get('slug'))) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->maxLength(255),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),

                Textarea::make('excerpt')
                    ->label('Short Description / Excerpt')
                    ->rows(3)
                    ->maxLength(500),

                FileUpload::make('feature_image')
                    ->label('Facility Feature Image')
                    ->directory('facilities')
                    ->image()
                    ->imageEditor(),

                Toggle::make('show_below_slider')
                    ->label('Show Below Hero Slider (Homepage Overlay)')
                    ->helperText('If enabled, this facility will appear in the glassmorphic overlay bar directly below the homepage slider.')
                    ->default(false),

                TextInput::make('order_by')
                    ->numeric()
                    ->default(0)
                    ->label('Sort Order'),

                Toggle::make('status')
                    ->label('Published')
                    ->default(true),

                Forms\Components\Builder::make('content')
                    ->label('Facility Detailed Content (TipTap Content Blocks)')
                    ->blocks(ContentBlocks::get('facility'))
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('feature_image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('show_below_slider')
                    ->label('Below Slider'),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status'),
                Tables\Columns\TextColumn::make('order_by')
                    ->sortable(),
            ])
            ->defaultSort('order_by', 'asc')
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
