<div x-data="{ open: false }"
     @keydown.window.ctrl.k.prevent="open = true; $nextTick(() => $refs.searchInput.focus())"
     @keydown.window.meta.k.prevent="open = true; $nextTick(() => $refs.searchInput.focus())"
     @keydown.escape.window="open = false">

    <button @click="open = true; $nextTick(() => $refs.searchInput.focus())"
            class="flex items-center justify-between gap-3 border border-neutral-300 px-2 rounded-2xl cursor-pointer">
        <x-Ui::icons.icon-fill :iconfill="'search'" class="w-5 h-auto block text-neutral-400"/>
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
            <div class="w-full border-b border-b-gray-200 h-1">&nbsp;</div>
            <ul>
                @forelse ($results as $item)
                    <li class="p-2 border-b">{{ $item['name'] ?? 'N/A' }}</li>
                @empty
                    <li class="p-2 text-gray-500">No results</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
