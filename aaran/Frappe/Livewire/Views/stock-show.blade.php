<div>
    <x-slot name="header">item</x-slot>

    <x-Ui::forms.m-panel>

        <x-Ui::loadings.loading/>

        <x-Ui::alerts.notification/>

        <h2 class="text-2xl font-semibold mb-6">Item Details</h2>

        <table class="table-auto w-full text-left border-collapse">
            <tbody>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600 w-1/3">Item Code</th>
                <td class="border-b p-2">{{ $item->item_code }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Item Name</th>
                <td class="border-b p-2">{{ $item->item_name }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Item Group</th>
                <td class="border-b p-2">{{ $item->item_group }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Brand</th>
                <td class="border-b p-2">{{ $item->brand }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Warehouse</th>
                <td class="border-b p-2">{{ $item->warehouse }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Opening Qty</th>
                <td class="border-b p-2">{{ $item->opening_qty }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Opening Valuation</th>
                <td class="border-b p-2">{{ Aaran\Assets\Helper\Format::rupeesFormat($item->opening_val) }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Balance Qty</th>
                <td class="border-b p-2">{{ $item->balance_qty ? $item->balance_qty:'-'  }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Balance Valuation</th>
                <td class="border-b p-2">₹{{ Aaran\Assets\Helper\Format::rupeesFormat($item->balance_val) }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Valuation Rate</th>
                <td class="border-b p-2">₹{{ Aaran\Assets\Helper\Format::rupeesFormat($item->valuation_rate) }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Created At</th>
                <td class="border-b p-2">{{ $item->created_at->format('d M Y, h:i A') }}</td>
            </tr>
            <tr>
                <th class="border-b p-2 font-medium text-gray-600">Updated At</th>
                <td class="border-b p-2">{{ $item->updated_at->format('d M Y, h:i A') }}</td>
            </tr>
            </tbody>
        </table>

    </x-Ui::forms.m-panel>
</div>
