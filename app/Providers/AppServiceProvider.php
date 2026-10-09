<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\EditorCommand;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Filament\Forms\Components\RichEditor\Actions\LinkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Support\Icons\Heroicon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Filament\Forms\Components\FileUpload::configureUsing(function (\Filament\Forms\Components\FileUpload $component): void {
            $component->maxSize(3072)
                ->getUploadedFileNameForStorageUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file): string {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $sanitizedName = \Illuminate\Support\Str::slug($originalName);

                    return ($sanitizedName ?: 'file') . '.' . $extension;
                });
        });

        if (class_exists(\Awcodes\Curator\Components\Forms\CuratorPicker::class)) {
            \Awcodes\Curator\Components\Forms\CuratorPicker::configureUsing(function (\Awcodes\Curator\Components\Forms\CuratorPicker $component): void {
                $component->maxSize(3072)
                    ->preserveFilenames();
            });
        }

        RichEditor::configureUsing(function (RichEditor $component): void {
            $component->tools([
                RichEditorTool::make('link')
                    ->label(__('filament-forms::components.rich_editor.tools.link'))
                    ->action(arguments: '{ url: $getEditor().getAttributes(\'link\')?.href, shouldOpenInNewTab: ($getEditor().isActive(\'link\') ? $getEditor().getAttributes(\'link\')?.target === \'_blank\' : false) }')
                    ->icon(Heroicon::Link)
                    ->iconAlias('forms:components.rich-editor.toolbar.link'),
            ])->registerActions([
                        LinkAction::make()
                            ->schema([
                                TextInput::make('url')
                                    ->label(__('filament-forms::components.rich_editor.actions.link.modal.form.url.label'))
                                    ->inputMode('url')
                                    ->required(),
                                Toggle::make('shouldOpenInNewTab')
                                    ->label(__('filament-forms::components.rich_editor.actions.link.modal.form.should_open_in_new_tab.label')),
                            ])
                            ->action(function (array $arguments, array $data, RichEditor $component): void {
                                $isSingleCharacterSelection = ($arguments['editorSelection']['head'] ?? null) === ($arguments['editorSelection']['anchor'] ?? null);

                                if (blank($data['url'] ?? null)) {
                                    $component->runCommands(
                                        [
                                            ...($isSingleCharacterSelection ? [
                                                EditorCommand::make(
                                                    'extendMarkRange',
                                                    arguments: ['link'],
                                                )
                                            ] : []),
                                            EditorCommand::make('unsetLink'),
                                        ],
                                        editorSelection: $arguments['editorSelection'],
                                    );

                                    return;
                                }

                                $component->runCommands(
                                    [
                                        ...($isSingleCharacterSelection ? [
                                            EditorCommand::make(
                                                'extendMarkRange',
                                                arguments: ['link'],
                                            )
                                        ] : []),
                                        EditorCommand::make(
                                            'setLink',
                                            arguments: [
                                                [
                                                    'href' => $data['url'],
                                                    'target' => $data['shouldOpenInNewTab'] ? '_blank' : '_self',
                                                ]
                                            ],
                                        ),
                                    ],
                                    editorSelection: $arguments['editorSelection'],
                                );
                            }),
                    ]);
        });

        \Illuminate\Pagination\Paginator::useBootstrapFive();
    }
}
