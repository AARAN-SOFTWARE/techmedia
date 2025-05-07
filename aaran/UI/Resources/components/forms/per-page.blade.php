<div class="flex items-center justify-between gap-3 p-2">
    <label for="perPage" class="text-gray-400">Per Page</label>
    <select wire:model.live="perPage" id="perPage"
            class="w-20 border  rounded-md h-10 p-2 border-gray-200 focus:border-0 focus:ring-2 focus:ring-blue-500">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</div>
