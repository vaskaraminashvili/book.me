<x-filament::card>
    @php
        dump($this->data);
            $rents = !empty($this->data['rent_history']['rent_history']) ? $this->data['rent_history']['rent_history'] : [];
            $count = !empty($this->data['rent_history']['count']) ? $this->data['rent_history']['count'] : 0;
    @endphp
    @if(!empty($rents))
        <div class="flex justify-between">
            <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                Showing Max Last 5 Records
            </h3>
            <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">
                rents count : {{$count}}
            </h3>
        </div>
        <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
            <thead class="divide-y divide-gray-200 dark:divide-white/5">
            <tr class="bg-gray-50 dark:bg-white/5">
                <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-title">
                    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                        <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                        Lessee
                        </span>
                    </span>
                </th>
                <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-title">
                    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                        <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                        Date range
                        </span>
                    </span>
                </th>
                <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-title">
                    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                        <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                        Daily Rate/Rate
                        </span>
                    </span>
                </th>
                <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-title">
                    <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                        <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                        Rating
                        </span>
                    </span>
                </th>
                <th class="w-1"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
            @if(!empty($rents))
                @foreach($rents as $record)
                    <tr class="fi-ta-row ">
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-title">
                            <div class="fi-ta-col-wrp">
                                <a href="{{route('filament.myspace.resources.rents.edit' , ['record' => $record->id])}}"
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
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-title">
                            <div class="fi-ta-col-wrp">
                                <a href="{{route('filament.myspace.resources.rents.edit' , ['record' => $record->id])}}"
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
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-title">
                            <div class="fi-ta-col-wrp">
                                <a href="{{route('filament.myspace.resources.rents.edit' , ['record' => $record->id])}}"
                                   class="flex w-full disabled:pointer-events-none justify-start text-start">
                                    <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">
                                        <div class="flex ">
                                            <div class="flex max-w-max" style="">
                                                <div class="fi-ta-text-item inline-flex items-center gap-1.5  ">
                                                    <span
                                                        class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white  "
                                                        style="">
                                                        {{$record->daily_rate ? $record->daily_rate : 'N/A'}}
                                                        /
                                                        {{$record->rate ? $record->rate : 'N/A'}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </td>
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-rating"
                            wire:key="h5EqdbPyMdzp3q4K7x5R.table.record.6.column.rating">
                            <div class="fi-ta-col-wrp">
                                <!--[if BLOCK]><![endif]-->
                                <div class="flex w-full disabled:pointer-events-none justify-start text-start">
                                    <div class="flex justify-center p-10" dir="ltr">
                                        <!--[if BLOCK]><![endif]-->
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($record->rating >= $i+1)
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="18"
                                                     height="18">
                                                    <path
                                                        d="M15.765,2.434l2.875,8.512l8.983,0.104c0.773,0.009,1.093,0.994,0.473,1.455l-7.207,5.364l2.677,8.576 c0.23,0.738-0.607,1.346-1.238,0.899L15,22.147l-7.329,5.196c-0.63,0.447-1.468-0.162-1.238-0.899l2.677-8.576l-7.207-5.364 c-0.62-0.461-0.3-1.446,0.473-1.455l8.983-0.104l2.875-8.512C14.482,1.701,15.518,1.701,15.765,2.434z"
                                                        fill="#ffc107"></path>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="18"
                                                     height="18">
                                                    <path
                                                        d="M15.765,2.434l2.875,8.512l8.983,0.104c0.773,0.009,1.093,0.994,0.473,1.455l-7.207,5.364l2.677,8.576 c0.23,0.738-0.607,1.346-1.238,0.899L15,22.147l-7.329,5.196c-0.63,0.447-1.468-0.162-1.238-0.899l2.677-8.576l-7.207-5.364 c-0.62-0.461-0.3-1.446,0.473-1.455l8.983-0.104l2.875-8.512C14.482,1.701,15.518,1.701,15.765,2.434z"
                                                        fill="#ddd"></path>
                                                </svg>
                                            @endif
                                        @endfor


                                        <!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                                <!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </td>
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-ta-actions-cell">
                            <div class="whitespace-nowrap px-3 py-4">
                                <div class="fi-ta-actions flex shrink-0 items-center gap-3 justify-end">
                                    <a href="{{route('filament.myspace.resources.rents.edit' , ['record' => $record->id])}}"
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
