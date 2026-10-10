<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostsResource\Pages;
use App\Filament\Resources\PostsResource\RelationManagers;
use App\Models\Posts;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Models\Media;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Awcodes\Curator\Components\Forms\RichEditor\AttachCuratorMediaPlugin;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Filament\Forms\Components\RichEditor\EditorCommand;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Awcodes\Curator\Components\Forms\CuratorPicker as FormsCuratorPicker;
use App\Filament\Shared\ContentBlocks;
use App\Filament\Shared\FeatureImageUpload;

class PostsResource extends Resource
{
    protected static ?string $model = Posts::class;
    protected static string $icon = 'heroicon-o-document-text';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static string|\UnitEnum|null $navigationGroup = 'CMS';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make("title")
                    ->label("Title")
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, Get $get, ?string $state) {
                        if (blank($get('slug'))) {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                FeatureImageUpload::make('file-manager/post/feature_image')
                    ->maxSize(3072),

                Forms\Components\Select::make('categories')
                    ->relationship('categories', 'name')
                    ->required()
                    ->preload()
                    ->multiple()
                    ->columns(2),

                Forms\Components\Select::make('tag_id')
                    ->label('Tag')
                    ->relationship('tag', 'name')
                    ->nullable()
                    ->searchable()
                    ->preload()
                    ->helperText('Optional tag for News & Events posts'),

                Forms\Components\Select::make('club_theme')
                    ->label('Club Card Theme & Color')
                    ->options([
                        'card-art'      => 'Art Theme (Wine / Palette)',
                        'card-eco'      => 'Eco Theme (Green / Seedling)',
                        'card-science'  => 'Science Theme (Navy / Flask)',
                        'card-heritage' => 'Heritage Theme (Gold / Landmark)',
                        'card-language' => 'Language Theme (Purple / Comments)',
                        'card-math'     => 'Math Theme (Teal / Formula)',
                        'card-sports'   => 'Sports Theme (Amber / Trophy)',
                        'card-value'    => 'Value Education Theme (Rose / Heart)',
                    ])
                    ->nullable()
                    ->searchable()
                    ->helperText('Select card color theme if post category is Our Clubs'),

                Forms\Components\TextInput::make('fa_icon')
                    ->label('FontAwesome Icon Class')
                    ->placeholder('fa-palette')
                    ->nullable()
                    ->maxLength(255)
                    ->helperText('e.g. fa-palette, fa-seedling, fa-flask, fa-trophy (Defaults to selected theme icon if blank)'),

                Forms\Components\TextInput::make('author')
                    ->label('Subtitle')
                    ->maxLength(255)
                    ->default(null),


                Forms\Components\RichEditor::make("excerpt")
                    ->label("Excerpt")
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'strike', 'bulletList', 'orderedList', 'link', 'blockquote', 'h2', 'h3',
                    ])
                    ->columnSpanFull(),

                Forms\Components\Builder::make("content")
                    ->label("Content")
                    ->blocks(ContentBlocks::get('post'))
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\TextInput::make('order_by')
                    ->numeric()
                    ->default(null),
                Forms\Components\DatePicker::make('publish_date')
                    ->required()
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('feature_image')
                    ->disk('public')
                    ->square()
                    ->size(40),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->label('Subtitle')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('publish_date')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePosts::route('/create'),
            'edit' => Pages\EditPosts::route('/{record}/edit'),
        ];
    }
}
