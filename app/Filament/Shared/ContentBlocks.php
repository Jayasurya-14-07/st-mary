<?php

namespace App\Filament\Shared;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Support\Icons\Heroicon;
use Awcodes\Curator\Components\Forms\RichEditor\AttachCuratorMediaPlugin;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Filament\Forms\Components\RichEditor\ToolbarButtonGroup;
use Filament\Forms\Components\RichEditor\EditorCommand;
use Filament\Schemas\Components\Utilities\Get;

class ContentBlocks
{
    public static function get($directory = 'page'): array
    {
        return [
            Block::make('heading')
                ->components([
                    TextInput::make('content')
                        ->label('Heading')
                        ->required(),
                    Select::make('level')
                        ->options([
                            'h1' => 'Heading 1',
                            'h2' => 'Heading 2',
                            'h3' => 'Heading 3',
                            'h4' => 'Heading 4',
                            'h5' => 'Heading 5',
                            'h6' => 'Heading 6',
                        ])
                        ->required(),
                ])
                ->columns(2),
            Block::make('Rich Editor')
                ->schema([
                    RichEditor::make('content')
                        ->label('Content')
                        ->toolbarButtons([
                            'h1', 'h2', 'h3', 'bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'blockquote', 'undo', 'redo',
                        ])
                        ->fileAttachmentsDirectory("file-manager/{$directory}/content")
                        ->required(),
                ]),
            Block::make('TipTap Editor')
                ->schema([
                    RichEditor::make('content')
                        ->label('Content')
                        ->customTextColors()
                        ->resizableImages()
                        ->plugins([
                            AttachCuratorMediaPlugin::make(),
                            \App\Filament\Plugins\TiptapVideoPlugin::make(),
                        ])
                        ->toolbarButtons([
                            ToolbarButtonGroup::make('Headings', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])
                                ->textualButtons(),
                            'bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'blockquote', 'codeBlock', 'undo', 'redo', 'grid', 'textColor', 'alignCenter', 'alignStart', 'alignEnd', 'alignJustify', 'table', 'horizontalRule', 'clearFormatting', 'subscript', 'superscript', 'attachFiles', 'video', 'image_url'
                        ])
                        ->tools([
                            RichEditorTool::make('video')
                                ->icon(Heroicon::VideoCamera)
                                ->label('Add Video URL')
                                ->action('video'),
                            RichEditorTool::make('image_url')
                                ->icon(Heroicon::Photo)
                                ->label('Add Image from Library')
                                ->action('attachCuratorMedia'),
                        ])
                        ->registerActions([
                            Action::make('video')
                                ->modalHeading('Insert Video')
                                ->schema([
                                    TextInput::make('url')
                                        ->label('URL')
                                        ->required()
                                        ->url(),
                                    \Filament\Schemas\Components\Grid::make(3)
                                        ->schema([
                                            Toggle::make('autoplay'),
                                            Toggle::make('loop'),
                                            Toggle::make('controls')
                                                ->default(true),
                                        ]),
                                    Toggle::make('responsive')
                                        ->default(true)
                                        ->live(),
                                    \Filament\Schemas\Components\Grid::make(2)
                                        ->schema([
                                            TextInput::make('width')
                                                ->numeric()
                                                ->default(16),
                                            TextInput::make('height')
                                                ->numeric()
                                                ->default(9),
                                        ])
                                        ->hidden(fn(Get $get) => $get('responsive')),
                                ])
                                ->action(function (array $data, RichEditor $component): void {
                                    $url = $data['url'];
                                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts|live)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                                        $embedUrl = "https://www.youtube.com/embed/{$match[1]}";
                                        $component->runCommands([
                                            EditorCommand::make('insertContent', arguments: [
                                                "<iframe src=\"{$embedUrl}\" width=\"100%\" height=\"400\" frameborder=\"0\" allowfullscreen></iframe>",
                                            ]),
                                        ]);
                                    } elseif (preg_match('%^https?://(?:www\.|player\.)?vimeo.com/(?:channels/(?:\w+/)?|groups/([^/]*)/videos/|album/(\d+)/video/|video/|)(\d+)(?:$|\/|\?)%i', $url, $match)) {
                                        $embedUrl = "https://player.vimeo.com/video/{$match[3]}";
                                        $component->runCommands([
                                            EditorCommand::make('insertContent', arguments: [
                                                "<iframe src=\"{$embedUrl}\" width=\"100%\" height=\"400\" frameborder=\"0\" allowfullscreen></iframe>",
                                            ]),
                                        ]);
                                    } else {
                                        $component->runCommands([
                                            EditorCommand::make('insertContent', arguments: [
                                                "<video src=\"{$url}\" width=\"100%\" controls></video>",
                                            ]),
                                        ]);
                                    }
                                }),
                        ])
                        ->fileAttachmentsDirectory("file-manager/{$directory}/content")
                        ->required(),
                ]),

            Block::make('image')
                ->components([
                    FileUpload::make('url')
                        ->label('Image')
                        ->imageEditor()
                        ->image()
                        ->openable()
                        ->required()
                        ->directory("file-manager/{$directory}/image"),
                    TextInput::make('alt')
                        ->label('Alt text')
                        ->required(),
                ]),

            Block::make('video')
                ->components([
                    TextInput::make('url')
                        ->label('Video URL')
                        ->required(),
                    Select::make('type')
                        ->options([
                            'youtube' => 'YouTube',
                            'vimeo' => 'Vimeo',
                        ])
                        ->required(),
                ]),

            Block::make('Image Carousel')
                ->components([
                    Repeater::make('images')
                        ->components([
                            FileUpload::make('url')
                                ->label('Image')
                                ->image()
                                ->openable()
                                ->required()
                                ->multiple()
                                ->directory("file-manager/{$directory}/image"),
                            TextInput::make('alt')
                                ->label('Alt text')
                                ->required(),
                        ])
                        ->columns(2)
                        ->createItemButtonLabel('Add Image'),
                ]),

            Block::make('iframe')
                ->components([
                    TextInput::make('url')
                        ->label('Iframe URL')
                        ->required(),
                    Select::make('type')
                        ->options([
                            'pdf' => 'PDF',
                            'other' => 'Other',
                        ])
                        ->required(),
                ]),

            Block::make('button')
                ->components([
                    TextInput::make('url')
                        ->label('Button URL')
                        ->required(),
                    TextInput::make('text')
                        ->label('Button Text')
                        ->required(),
                    Select::make('type')
                        ->options([
                            'primary' => 'Primary',
                            'secondary' => 'Secondary',
                            'tertiary' => 'Tertiary',
                        ])
                        ->required(),
                    Toggle::make('open_in_new_tab')
                        ->label('Open in new tab')
                        ->default(false),
                ]),

            Block::make('accordion')
                ->components([
                    Repeater::make('items')
                        ->label('Accordion Items')
                        ->components([
                            TextInput::make('title')
                                ->label('Accordion Title')
                                ->required(),
                            self::tipTapContentEditor('content', 'Accordion Content', $directory)
                                ->required(),
                            Repeater::make('tabs')
                                ->label('Tabs (Optional)')
                                ->components([
                                    TextInput::make('title')->label('Tab Title')->required(),
                                    self::tipTapContentEditor('content', 'Tab Content', $directory)->required(),
                                ])
                                ->addable()
                                ->deletable()
                                ->reorderable(),
                            Repeater::make('carousel')
                                ->label('Carousel Items (Optional)')
                                ->components([
                                    Repeater::make('images')
                                        ->label('Images')
                                        ->components([
                                            FileUpload::make('url')
                                                ->label('Image')
                                                ->image()
                                                ->directory("file-manager/{$directory}/carousel"),
                                            TextInput::make('alt')
                                                ->label('Alt Text')
                                                ->required(false),
                                        ])
                                        ->addable()
                                        ->deletable()
                                        ->reorderable(),
                                ])
                                ->addable()
                                ->deletable()
                                ->reorderable(),
                        ])
                        ->minItems(1)
                        ->addable()
                        ->deletable()
                        ->reorderable(),
                ]),

            Block::make('tabs')
                ->components([
                    Repeater::make('items')
                        ->label('Tab Items')
                        ->components([
                            TextInput::make('title')
                                ->label('Tab Title')
                                ->required(),
                            self::tipTapContentEditor('content', 'Tab Content', $directory)
                                ->required(),
                            Repeater::make('accordion')
                                ->label('Accordion Items (Optional)')
                                ->components([
                                    TextInput::make('heading')->label('Heading')->required(),
                                    self::tipTapContentEditor('body', 'Body', $directory)->required(),
                                ])
                                ->addable()
                                ->deletable()
                                ->reorderable(),
                        ])
                        ->minItems(1)
                        ->addable()
                        ->deletable()
                        ->reorderable(),
                ]),

            Block::make('Custom Grid')
                ->schema([
                    Repeater::make('items')
                        ->schema([
                            FileUpload::make('url')
                                ->label('Image')
                                ->image()
                                ->imagePreviewHeight('160')
                                ->panelLayout('compact')
                                ->openable()
                                ->directory("file-manager/{$directory}/grid/images"),
                            TextInput::make('title')
                                ->label('Title'),
                            RichEditor::make('content')
                                ->label('Content')
                                ->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'underline',
                                    'strike',
                                    'link',
                                    'bulletList',
                                    'orderedList',
                                    'undo',
                                    'redo',
                                ])
                                ->extraInputAttributes([
                                    'style' => 'min-height: 8rem; max-height: 18rem; overflow-y: auto;',
                                ]),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Grid item')
                        ->defaultItems(1)
                        ->collapsible()
                        ->columns(1),
                    TextInput::make('columns')
                        ->label('Columns')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(4)
                        ->default(3),
                ]),
        ];
    }

    private static function tipTapContentEditor(string $name, string $label, string $directory): RichEditor
    {
        return RichEditor::make($name)
            ->label($label)
            ->customTextColors()
            ->resizableImages()
            ->plugins([
                AttachCuratorMediaPlugin::make(),
                \App\Filament\Plugins\TiptapVideoPlugin::make(),
            ])
            ->toolbarButtons([
                ToolbarButtonGroup::make('Headings', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])
                    ->textualButtons(),
                'bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList', 'blockquote', 'codeBlock', 'undo', 'redo', 'grid', 'textColor', 'alignCenter', 'alignStart', 'alignEnd', 'alignJustify', 'table', 'horizontalRule', 'clearFormatting', 'subscript', 'superscript', 'attachFiles', 'video', 'image_url'
            ])
            ->tools([
                RichEditorTool::make('video')
                    ->icon(Heroicon::VideoCamera)
                    ->label('Add Video URL')
                    ->action('video'),
                RichEditorTool::make('image_url')
                    ->icon(Heroicon::Photo)
                    ->label('Add Image from Library')
                    ->action('attachCuratorMedia'),
            ])
            ->registerActions([
                Action::make('video')
                    ->modalHeading('Insert Video')
                    ->schema([
                        TextInput::make('url')
                            ->label('URL')
                            ->required()
                            ->url(),
                        \Filament\Schemas\Components\Grid::make(3)
                            ->schema([
                                Toggle::make('autoplay'),
                                Toggle::make('loop'),
                                Toggle::make('controls')
                                    ->default(true),
                            ]),
                        Toggle::make('responsive')
                            ->default(true)
                            ->live(),
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('width')
                                    ->numeric()
                                    ->default(16),
                                TextInput::make('height')
                                    ->numeric()
                                    ->default(9),
                            ])
                            ->hidden(fn(Get $get) => $get('responsive')),
                    ])
                    ->action(function (array $data, RichEditor $component): void {
                        $url = $data['url'];

                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts|live)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                            $url = "https://www.youtube.com/embed/{$match[1]}";
                            $content = "<iframe src=\"{$url}\" width=\"100%\" height=\"400\" frameborder=\"0\" allowfullscreen></iframe>";
                        } elseif (preg_match('%^https?://(?:www\.|player\.)?vimeo.com/(?:channels/(?:\w+/)?|groups/([^/]*)/videos/|album/(\d+)/video/|video/|)(\d+)(?:$|\/|\?)%i', $url, $match)) {
                            $url = "https://player.vimeo.com/video/{$match[3]}";
                            $content = "<iframe src=\"{$url}\" width=\"100%\" height=\"400\" frameborder=\"0\" allowfullscreen></iframe>";
                        } else {
                            $content = "<video src=\"{$url}\" width=\"100%\" controls></video>";
                        }

                        $component->runCommands([
                            EditorCommand::make('insertContent', arguments: [$content]),
                        ]);
                    }),
            ])
            ->fileAttachmentsDirectory("file-manager/{$directory}/content");
    }
}
