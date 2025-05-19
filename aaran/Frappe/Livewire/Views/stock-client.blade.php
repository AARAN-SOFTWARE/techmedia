<div>
    <x-slot name="header">item</x-slot>

    <x-Ui::forms.m-panel>

        <x-Ui::loadings.loading/>

        <x-Ui::alerts.notification/>

        <h2 class="text-2xl font-semibold mb-6">Item Details</h2>

        <div class="flex flex-row gap-2">

            <div class="border w-[32rem] border-gray-200 p-2 flex items-center justify-center">
                <img src="https://techmedia.co.in/{{$item_detail['image']}}" alt="" class="w-fit h-auto">
            </div>

            <div class="grid grid-cols-2  w-full bg-white text-black gap-3">
                <div class="border-b p-2 text-gray-500">Brand</div>
                <div class="border-b p-2">{{ $item_detail['brand'] }}</div>

                <div class="border-b p-2 text-gray-500">Item Code</div>
                <div class="border-b p-2">{{ $item->item_code }}</div>

                <div class="border-b p-2 text-gray-500">Item Name</div>
                <div class="border-b p-2">{{ $item->item_name }}</div>

                <div class="border-b p-2 text-gray-500">Item Group</div>
                <div class="border-b p-2">{{ $item->item_group }}</div>

                <div class="border-b p-2 text-gray-500">In Stock</div>
                <div class="border-b p-2">{{ $item->balance_qty ? $item->balance_qty:'-'  }}</div>

                <div class="border-b p-2 text-gray-500">Price</div>
                <div class="border-b p-2">{{ Aaran\Assets\Helper\Format::rupeesFormat($item->valuation_rate) }}</div>
            </div>

        </div>

    </x-Ui::forms.m-panel>
</div>
