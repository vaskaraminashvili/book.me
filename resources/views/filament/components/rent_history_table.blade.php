<x-filament::card>
    @php
        dump($this->data);
            $rents = !empty($this->data['rent_history']['rent_history']) ? $this->data['rent_history']['rent_history'] : [];
            $count = !empty($this->data['rent_history']['count']) ? $this->data['rent_history']['count'] : 0;
    @endphp
    @if(!empty($rents))
        <div>Showing Last 5 Records</div>
        <div>rents count : {{$count}}</div>
        <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
            <thead class="divide-y divide-gray-200 dark:divide-white/5">
            <tr class="bg-gray-50 dark:bg-white/5">
                <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-title"
                    style=";">
                    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                    <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                    Title
                    </span>
                    </span>
                </th>
                <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-title"
                    style=";">
                    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                    <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                    Title
                    </span>
                    </span>
                </th>
                <th class="w-1"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">

            @if(!empty($rents))

                @foreach($rents as $record)

                    <tr
                        class="fi-ta-row [@media(hover:hover)]:transition [@media(hover:hover)]:duration-75 hover:bg-gray-50 dark:hover:bg-white/5"
                        wire:key="Ct6dU8ixLjF8fNm9v9VC.table.records.2">
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-title"
                            wire:key="Ct6dU8ixLjF8fNm9v9VC.table.record.2.column.title">
                            <div class="fi-ta-col-wrp">
                                <a href="http://book.me.test/myspace/flats/2/edit"
                                   class="flex w-full disabled:pointer-events-none justify-start text-start">
                                    <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">
                                        <div class="flex ">
                                            <div class="flex max-w-max" style="">
                                                <div class="fi-ta-text-item inline-flex items-center gap-1.5  ">
                                            <span
                                                class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white  "
                                                style="">
                                            {{$record->lessee}}
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </td>
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-status"
                            wire:key="Ct6dU8ixLjF8fNm9v9VC.table.record.2.column.status">
                            <div class="fi-ta-col-wrp">
                                <a href="http://book.me.test/myspace/flats/2/edit"
                                   class="flex w-full disabled:pointer-events-none justify-start text-start">
                                    <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">
                                        <div class="flex ">
                                            <div class="flex max-w-max" style="">
                                                <div class="fi-ta-text-item inline-flex items-center gap-1.5  ">
                                            <span
                                                class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white  "
                                                style="">
                                            {{$record->range}}
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </td>
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-ta-actions-cell">
                            <div class="whitespace-nowrap px-3 py-4">
                                <div class="fi-ta-actions flex shrink-0 items-center gap-3 justify-end">
                                    <a href="http://book.me.test/myspace/flats/2/edit"
                                       class="fi-link group/link relative inline-flex items-center justify-center outline-none fi-size-sm fi-link-size-sm gap-1 fi-color-custom fi-color-primary fi-ac-action fi-ac-link-action">
                                        <svg style="--c-400:var(--primary-400);--c-600:var(--primary-600);"
                                             class="fi-link-icon h-4 w-4 text-custom-600 dark:text-custom-400"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true" data-slot="icon">
                                            <path
                                                d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z"></path>
                                            <path
                                                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z"></path>
                                        </svg>
                                        <span
                                            class="font-semibold group-hover/link:underline group-focus-visible/link:underline text-sm text-custom-600 dark:text-custom-400"
                                            style="--c-400:var(--primary-400);--c-600:var(--primary-600);">
                                Open
                                </span>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    @else
        <p>Old rent History</p>
    @endif
</x-filament::card>
