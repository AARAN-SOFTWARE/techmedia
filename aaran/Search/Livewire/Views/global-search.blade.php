<div x-data="{ open: false }"
     @keydown.window.ctrl.k.prevent="open = true; $nextTick(() => $refs.searchInput.focus())"
     @keydown.window.meta.k.prevent="open = true; $nextTick(() => $refs.searchInput.focus())"
     x-cloak
     x-trap.inert.noscroll="open"
     @keydown.escape.window="
         open = false;
         $wire.set('query', '');
     ">

    <button @click="open = true; $nextTick(() => $refs.searchInput.focus())"
            class="flex items-center justify-between gap-3 border border-neutral-400 px-2 hover:bg-amber-100 rounded-2xl cursor-pointer">
        <x-Ui::icons.icon-fill :iconfill="'search'" class="w-4 h-auto block text-neutral-400"/>
        <span class="text-gray-400">Ctrl K</span>
    </button>

    <div x-show="open" class="fixed inset-0 bg-stone-900/30 bg-opacity-50 z-50 flex items-start justify-center pt-20"
         x-cloak>
        <div class="bg-white w-full max-w-2xl rounded shadow p-4">

            <div class="flex justify-between items-center gap-2">
                <x-Ui::icons.icon-fill :iconfill="'search'" class="w-5 h-auto block text-neutral-400"/>
                <input type="text"
                       x-ref="searchInput"
                       wire:model.live.debounce.300ms="query"
                       class="w-full p-2 mb-2 bg-transparent focus:outline-none focus:ring-0 focus:border-none border-none ring-0 hover:ring-0 hover:border-none"
                       placeholder="Search..."
                       x-ref="searchInput">
                <span class="text-gray-400 rounded-md text-xs p-0.5 border border-neutral-300">Esc</span>
            </div>
            <div class="w-full border-b border-b-gray-200 overflow-y-auto h-1">&nbsp;</div>
            <ul class="max-h-[30rem] overflow-y-auto divide-y scrollbar-thin overscroll-contain divide-gray-100">
            @forelse ($results as $item)
                    <li class="p-2 border-b flex justify-between hover:bg-amber-100">
                        <a href="{{route('stock-show',$item['id'])}}"
                            class="cursor-pointer" >{{ $item['item_name'] ?? 'N/A' }}</a>

                        <div class="cursor-pointer group"
                             wire:click.prevent='addToFavorites("user", @json($item["item_name"]))'>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 class="w-6 h-6 text-gray-300 stroke-gray-200 group-hover:fill-blue-300 group-hover:stroke-blue-500 transition">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M11.48 3.499a.75.75 0 011.04 0l2.62 2.656
                                         3.548.516a.75.75 0 01.416 1.279l-2.566 2.5
                                         .606 3.537a.75.75 0 01-1.09.79L12 13.347l-3.174
                                         1.66a.75.75 0 01-1.09-.79l.606-3.537-2.566-2.5a.75.75
                                         0 01.416-1.28l3.548-.516 2.62-2.655z"/>
                            </svg>
                        </div>
                    </li>
                @empty
                    <li class="p-2 text-gray-500">No results</li>
                    <div class="w-full border-b border-gray-200 my-2"></div>
                @endforelse


                @if(empty($query))
                    <div>
                    <div class="flex flex-row w-full gap-2">
                        <div class="w-full border-r border-gray-200 p-1">
                            @if($history->isNotEmpty())
                                <h4 class="text-sm text-left text-gray-300 mb-1">History</h4>
                                    @foreach ($history as $h)
                                        <div class="p-1 text-gray-700 flex items-center justify-between hover:bg-gray-100 group">
                                            <div class="flex items-center gap-2">
                                                <!-- History Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-5 h-5 text-gray-200 group-hover:text-gray-400 transition"
                                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 6v6l4 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ $h->query }}
                                            </div>

                                            <!-- Remove Icon (X) -->
                                            <div class="cursor-pointer"
                                                 wire:click.prevent="removeFromHistory({{ $h->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-5 h-5 text-gray-200 hover:text-gray-400 transition"
                                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </div>
                                        </div>

                                    @endforeach
                            @endif
                        </div>

                        <div class="w-full">
                            @if($favorites->isNotEmpty())

                                <h4 class="text-sm text-left text-gray-300 mb-1">Favorites</h4>
                                    @foreach ($favorites as $fav)
                                        <li class="p-1 text-gray-700 flex justify-between">
                                            {{ ucfirst($fav->type) }}
                                            #{{ $fav->query }}

                                            <div class="cursor-pointer group"
                                                 wire:click.prevent="removeFromFavorites({{ $fav['id'] }})">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     class="w-6 h-6 fill-blue-300 stroke-blue-500 group-hover:fill-gray-50 group-hover:stroke-gray-300 transition">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          d="M11.48 3.499a.75.75 0 011.04 0l2.62 2.656
                                                             3.548.516a.75.75 0 01.416 1.279l-2.566 2.5
                                                             .606 3.537a.75.75 0 01-1.09.79L12 13.347l-3.174
                                                             1.66a.75.75 0 01-1.09-.79l.606-3.537-2.566-2.5a.75.75
                                                             0 01.416-1.28l3.548-.516 2.62-2.655z"/>
                                                </svg>
                                            </div>
                                        </li>
                                    @endforeach
                            @endif
                        </div>
                    </div>
                    </div>
                @endif


            </ul>
        </div>
    </div>
</div>
