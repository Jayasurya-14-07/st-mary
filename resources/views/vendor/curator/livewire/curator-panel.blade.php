<div
    x-data="{
        selected: $wire.entangle('selected'),
        multiple: {{ $isMultiple ? 'true' : 'false' }},
        handleItemClick: function (media = null) {
            if (! media) return;

            if (this.isSelected(media.id)) {
                this.removeFromSelection(media.id);
                return;
            }

            if (! this.multiple) {
                this.selected = [];
            }

            this.addToSelection(media);
        },
        hasSelection: function () {
            return this.selected.length > 0;
        },
        isSelected: function (id = null) {
            if (! this.hasSelection()) return false;

            return this.selected.find(function (item) {
                return item.id == id;
            }) !== undefined;
        },
        addToSelection: function (media = null) {
            if (! media) return;

            this.selected.push(media);
        },
        removeFromSelection: function (id = null) {
            if (! id) return;

            this.selected = this.selected.filter(function (item) {
                return item.id != id;
            });
        },
    }"
    class="curator-panel h-full absolute inset-0 flex flex-col"
>
    <!-- Controls -->
    <div
        x-show="hasSelection()"
        class="curator-panel-controls fixed bottom-0 md:bottom-auto md:top-4 inset-x-0 pointer-events-none transition z-20 flex justify-center"
        x-transition:enter="ease-out duration-100"
        x-transition:enter-start="opacity-0 translate-y-0 md:-translate-y-4"
        x-transition:enter-end="opacity-100 -translate-y-4 md:translate-y-0"
        x-transition:leave="ease-in duration-100"
        x-transition:leave-start="opacity-100 -translate-y-4 md:translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-0 md:-translate-y-4"
        x-cloak
    >
        <div class="bg-black md:bg-gray-800 md:rounded-xl p-3 w-full md:w-auto flex items-center gap-3 pointer-events-auto">
            {{ $this->insertMedia }}
            <x-filament::button
                color="gray"
                size="sm"
                x-on:click="selected = []"
            >
                {{ trans('curator::views.panel.deselect_all') }}
            </x-filament::button>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="curator-panel-toolbar px-4 py-2 flex items-center justify-between bg-gray-200/70 dark:bg-black/20 dark:text-white border-b border-gray-300 dark:border-gray-800">
        <div class="flex items-center gap-2">
            @if($currentPage < $lastPage)
            <x-filament::button
                size="xs"
                color="gray"
                wire:click="loadMoreFiles()"
            >
                {{ trans('curator::views.panel.load_more') }}
            </x-filament::button>
            @endif
        </div>
        <div class="flex items-center gap-4">
            <label class="shrink-0 border border-gray-300 dark:border-gray-700 rounded-md relative flex items-center">
                <span class="sr-only">{{ trans('curator::views.panel.search_label') }}</span>
                <x-filament::input.wrapper
                    prefix-icon="heroicon-s-magnifying-glass"
                    prefix-icon-alias="curator::icons.search"
                >
                    <x-filament::input
                        type="search"
                        placeholder="{{ trans('curator::views.panel.search_placeholder') }}"
                        wire:model.live.debounce.500ms="search"
                    />
                </x-filament::input.wrapper>
                <svg fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="animate-spin h-4 w-4 text-gray-400 dark:text-gray-500 sm absolute right-2 z-10" wire:loading.delay wire:target="search">
                    <path clip-rule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill-rule="evenodd" fill="currentColor" opacity="0.2"></path>
                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                </svg>
            </label>
            <x-filament::icon-button
                x-on:click="close()"
                icon="heroicon-o-x-mark"
                color="gray"
            />
        </div>
    </div>
    <!-- End Toolbar -->

    <div class="flex-1 relative flex flex-col lg:flex-row overflow-hidden dark:bg-gray-950/30">
        <!-- Gallery -->
        <div class="curator-panel-gallery flex-1 h-full overflow-auto p-4">
            <ul @class([
                'text-sm flex items-center',
                'mb-4' => filled($breadcrumbs),
            ])>
                @if ($breadcrumbs)
                    @foreach($breadcrumbs as $breadcrumb)
                        <li wire:key="breadcrumb-{{ $breadcrumb['path'] }}">
                            <div>
                                @if ($loop->last)
                                    <span class="opacity-50">{{ $breadcrumb['label'] }}</span>
                                @else
                                    <button
                                        type="button"
                                        wire:click.prevent="handleDirectoryChange('{{ $breadcrumb['path'] }}')"
                                        class="hover:text-primary-500 focus:text-primary-500"
                                    >
                                        {{ $breadcrumb['label'] }}
                                    </button>
                                    <span>/&nbsp;</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
            <ul class="curator-picker-grid">
                @if ($subDirectories)
                    @foreach($subDirectories as $dir)
                        <li
                            wire:key="dir-{{ $dir['name'] }}" class="relative aspect-square"
                        >
                            <button
                                type="button"
                                wire:click="handleDirectoryChange('{{ $dir['path'] }}')"
                                class="block w-full h-full overflow-hidden bg-gray-200 rounded-md dark:bg-gray-900 hover:text-primary-600 hover:bg-primary-500/20 hover:ring-2 hover:ring-primary-500 dark:hover:text-white dark:hover:bg-primary-500/20 focus:text-primary-600 focus:bg-primary-500/20 focus:ring-2 focus:ring-primary-500"
                            >
                                <div class="grid place-content-center place-items-center w-full h-full text-xs relative">
                                    <x-filament::icon
                                        alias="curator::icons.folder"
                                        icon="heroicon-o-folder"
                                        class="w-12 h-12 opacity-20"
                                    />
                                    <span>{{ $dir['label'] }}</span>
                                </div>
                            </button>
                        </li>
                    @endforeach
                @endif
                @forelse ($files as $file)
                    <li
                        wire:key="media-{{ $file['id'] }}"
                        class="relative aspect-square group"
                    >
                        <button
                            type="button"
                            x-on:click="handleItemClick(@js($file))"
                            @class([
                              'block w-full h-full overflow-hidden bg-gray-700 rounded-md checkered',
                              'p-2' => curator()->isSvg($file['ext']),
                            ])
                        >
                            <x-curator::display
                                :item="$file"
                                :src="$file['thumbnail_url']"
                                :alt="$file['alt'] ?? ''"
                                icon-classes="size-12"
                                width="200"
                                height="200"
                            />
                        </button>

                        <button
                            type="button"
                            x-on:click="removeFromSelection({{ $file['id']}})"
                            x-show="isSelected('{{ $file['id'] }}')"
                            x-cloak
                            class="absolute inset-0 flex items-center justify-center w-full h-full rounded-md shadow text-primary-600 bg-primary-500/20 ring-2 ring-primary-500"
                        >
                            <span class="flex items-center justify-center w-8 h-8 text-white rounded-full bg-primary-500 drop-shadow">
                                <x-filament::icon
                                    alias="curator::icons.check"
                                    icon="heroicon-s-check"
                                    class="w-5 h-5"
                                />
                            </span>
                            <span class="sr-only">
                                {{ trans('curator::views.panel.deselect') }}
                            </span>
                        </button>

                        <div
                            class="absolute top-1 right-1 flex justify-center shadow-md rounded bg-gray-800 opacity-0 pointer-events-none transition group-hover:opacity-100 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:pointer-events-auto"
                        >
                            <div class="flex items-center justify-center w-8 h-8">
                                <x-filament-actions::group
                                    :actions="[
                                        ($this->viewItemAction)(['item' => $file]),
                                        ($this->downloadItemAction)(['item' => $file]),
                                        ($this->editItemAction)(['item' => $file]),
                                        ($this->destroyItemAction)(['item' => $file]),
                                    ]"
                                    color="primary"
                                    icon-size="sm"
                                    dropdown-placement="bottom-start"
                                    dropdown-width="max-w-48"
                                />
                            </div>
                        </div>

                        <p
                            class="text-xs truncate absolute bottom-0 inset-x-0 px-1 pb-1 pt-4 rounded-b text-white bg-gradient-to-t from-black/80 to-transparent pointer-events-none opacity-0 transition group-hover:opacity-100 group-focus-within:opacity-100"
                        >
                            {{ $file['pretty_name'] }}
                        </p>
                    </li>
                @empty
                    @empty($subDirectories)
                        <li class="col-span-3 sm:col-span-4 md:col-span-6 lg:col-span-8">
                            {{ trans('curator::views.panel.empty') }}
                        </li>
                    @endempty
                @endforelse
            </ul>
        </div>
        <!-- End Gallery -->

        <!-- Sidebar -->
        <div
            class="curator-panel-sidebar flex flex-col z-[1] border-l border-gray-300 dark:border-gray-800 bg-gray-100 dark:bg-gray-900 shrink-0"
            style="width: 440px; min-width: 440px; max-width: 440px; height: 100%; max-height: 100%; overflow: hidden; display: flex; flex-direction: column;"
        >
            <!-- Selected Files Preview (if any selected) -->
            <div x-show="hasSelection()" class="border-b border-gray-200 dark:border-gray-800 p-3 bg-white dark:bg-gray-950 shrink-0" style="max-height: 150px; overflow-y: auto;">
                <h4 class="font-bold text-sm mb-2">
                    Selected Files
                </h4>
                <div class="flex flex-wrap gap-2">
                    <template x-for="media in selected" :key="media.id">
                        <div class="w-10 h-10 rounded overflow-hidden relative group">
                            <img
                                x-bind:src="media.url"
                                class="w-10 h-10 object-cover object-center rounded"
                                x-bind:alt="media.alt"
                                width="100"
                                height="100"
                            />
                            <button
                                type="button"
                                class="opacity-0 bg-danger-500 w-full grid place-content-center group-hover:opacity-100 absolute inset-0"
                                x-on:click="removeFromSelection(media.id)"
                            >
                                <x-filament::icon
                                    alias="curator::icons.remove"
                                    icon="heroicon-s-x-mark"
                                    class="w-6 h-6 text-white"
                                />
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Sticky Top Header & Buttons -->
            <div class="px-4 pt-4 pb-3 border-b border-gray-200 dark:border-gray-800 bg-gray-100 dark:bg-gray-900 shrink-0 shadow-sm z-10">
                <h4 class="font-bold text-base mb-2 text-gray-900 dark:text-gray-100">
                    {{ trans('curator::views.panel.add_files') }}
                </h4>

                <div class="flex items-center justify-start gap-2">
                    @if ($this->addFilesAction->isVisible())
                        {{ $this->addFilesAction }}
                        {{ $this->addInsertFilesAction }}
                    @endif
                </div>
            </div>

            <!-- Scrollable Upload Area with Visible Scrollbar -->
            <div
                class="curator-uploader-scroll-container flex-1"
                style="overflow-y: scroll !important; overflow-x: hidden !important; height: calc(100% - 90px); min-height: 0; padding: 1rem; scrollbar-width: thin; scrollbar-color: #94a3b8 #f1f5f9;"
            >
                <div class="w-full pb-10">
                    {{ $this->form }}
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <x-filament-actions::modals />
    </div>

    <style>
        /* Force scroll area to show vertical scrollbar and allow mouse/touch scrolling */
        .curator-uploader-scroll-container {
            overflow-y: scroll !important;
            overflow-x: hidden !important;
            -webkit-overflow-scrolling: touch !important;
            overscroll-behavior-y: contain !important;
        }

        .curator-uploader-scroll-container::-webkit-scrollbar {
            width: 10px !important;
            display: block !important;
        }

        .curator-uploader-scroll-container::-webkit-scrollbar-track {
            background: #f1f5f9 !important;
            border-radius: 6px !important;
        }

        .curator-uploader-scroll-container::-webkit-scrollbar-thumb {
            background: #94a3b8 !important;
            border-radius: 6px !important;
            border: 2px solid #f1f5f9 !important;
        }

        .curator-uploader-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #64748b !important;
        }

        .dark .curator-uploader-scroll-container::-webkit-scrollbar-track {
            background: #1e293b !important;
        }

        .dark .curator-uploader-scroll-container::-webkit-scrollbar-thumb {
            background: #475569 !important;
            border: 2px solid #1e293b !important;
        }

        /* FilePond inside Curator scroll container */
        .curator-uploader-scroll-container .filepond--root {
            overflow: visible !important;
            min-height: 180px !important;
        }

        .curator-uploader-scroll-container .filepond--list-scroller {
            overflow: visible !important;
        }

        .curator-uploader-scroll-container .filepond--item {
            margin-bottom: 0.5rem !important;
        }
    </style>
</div>
