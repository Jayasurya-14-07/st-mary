<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadershipMessageResource\Pages;
use App\Models\LeadershipMessage;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use App\Filament\Shared\ContentBlocks;
use App\Filament\Shared\FeatureImageUpload;

class LeadershipMessageResource extends Resource
{
    protected static ?string $model = LeadershipMessage::class;

    protected static ?string $navigationLabel = 'Leadership Messages';
    protected static ?string $modelLabel = 'Leadership Message';
    protected static ?string $pluralModelLabel = 'Leadership Messages';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static string|\UnitEnum|null $navigationGroup = 'Sections';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("name")
                    ->label("Author Name")
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
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('position')
                    ->label('Position / Role')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('e.g. Principal, Management, Head Boy, Head Girl (Must be unique)'),

                TextInput::make('subtext')
                    ->label('Signature Subtext')
                    ->nullable()
                    ->maxLength(255)
                    ->placeholder('St. Mary’s Convent School, Chhallan Ramkot')
                    ->helperText('Organization / School signature line below quote'),

                TextInput::make('icon')
                    ->label('FontAwesome Icon Class')
                    ->nullable()
                    ->placeholder('fa-user-tie')
                    ->maxLength(255)
                    ->helperText('e.g. fa-user-tie, fa-building-columns, fa-user-graduate, fa-graduation-cap'),

                FeatureImageUpload::make('file-manager/leadership/feature_image')
                    ->label('Author Photo')
                    ->maxSize(3072),

                RichEditor::make("excerpt")
                    ->label("Quote & Excerpt")
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike', 'bulletList', 'orderedList', 'link', 'blockquote', 'h2', 'h3',
                    ])
                    ->columnSpanFull(),

                Builder::make("content")
                    ->label("Full Page Detail Content")
                    ->blocks(ContentBlocks::get('post'))
                    ->columnSpanFull(),

                TextInput::make('order_by')
                    ->label('Order By')
                    ->numeric()
                    ->default(0),

                Toggle::make('status')
                    ->label('Active Status')
                    ->required()
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('feature_image')
                    ->label('Photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Author Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon'),
                Tables\Columns\TextColumn::make('order_by')
                    ->label('Order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->boolean(),
            ])
            ->defaultSort('order_by', 'asc')
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

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLeadershipMessages::route('/'),
            'create' => Pages\CreateLeadershipMessage::route('/create'),
            'edit'   => Pages\EditLeadershipMessage::route('/{record}/edit'),
        ];
    }
}
