<div>
    <x-slot name="header">item</x-slot>

    <x-Ui::forms.m-panel>

        <x-Ui::loadings.loading/>

        <x-Ui::alerts.notification/>

        <h2 class="text-2xl font-semibold mb-6">Item Details</h2>

        <div class="grid grid-cols-4 bg-white text-black gap-3">

            <div class="border-b p-2 text-gray-500">Brand</div>
            <div class="border-b p-2">{{ $item->brand }}</div>

            <div class="border-b p-2 text-gray-500">Item Code</div>
            <div class="border-b p-2">{{ $item->item_code }}</div>

            <div class="border-b p-2 text-gray-500">Item Name</div>
            <div class="border-b p-2">{{ $item->item_name }}</div>

            <div class="border-b p-2 text-gray-500">Item Group</div>
            <div class="border-b p-2">{{ $item->item_group }}</div>

            <div class="border-b p-2 text-gray-500">Balance Qty</div>
            <div class="border-b p-2">{{ $item->balance_qty ? $item->balance_qty:'-'  }}</div>

            <div class="border-b p-2 text-gray-500">Valuation Rate</div>
            <div class="border-b p-2">{{ Aaran\Assets\Helper\Format::rupeesFormat($item->valuation_rate) }}</div>

        </div>

        <x-Ui::table.form>
            <x-slot:table_header>
{{--                <x-Ui::table.header-text sortIcon="none">Modified</x-Ui::table.header-text>--}}
                <x-Ui::table.header-text sortIcon="none">invoice</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">supplier_name</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Purchase Qty</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Price</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Taxable</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Gst</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Amount</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Val Rate</x-Ui::table.header-text>
            </x-slot:table_header>

            <x-slot:table_body>

                @forelse($stockData as $row)

                    @php
                        //       $link = route('stock-show', $row->id);
                               $link = route('dashboard');
                    @endphp

                    @if(isset($row['item_code']))
                        <x-Ui::table.row>

{{--                            <x-Ui::table.cell-link :href="$link">--}}
{{--                                {{ date('d-m-Y', strtotime( $row['modified']))}}--}}
{{--                            </x-Ui::table.cell-link>--}}

                            <x-Ui::table.cell-link :href="$link">{{ $row['invoice'] }}</x-Ui::table.cell-link>
                            <x-Ui::table.cell-link :href="$link">{{ $row['supplier_name'] }}</x-Ui::table.cell-link>

                            <x-Ui::table.cell-link
                                :href="$link">{{ $row['stock_qty'] ? $row['stock_qty'] +0 :'-' }}</x-Ui::table.cell-link>

                            <x-Ui::table.cell-link :href="$link"
                                                   right>{{  Aaran\Assets\Helper\Format::Decimal($row['rate']) }}</x-Ui::table.cell-link>

                            <x-Ui::table.cell-link :href="$link"
                                                   right>{{  Aaran\Assets\Helper\Format::Decimal($row['amount']) }}</x-Ui::table.cell-link>

                            <x-Ui::table.cell-link :href="$link"
                                                   right>{{  Aaran\Assets\Helper\Format::Decimal($row['total_tax']) }}</x-Ui::table.cell-link>

                            <x-Ui::table.cell-link :href="$link"
                                                   right>{{  Aaran\Assets\Helper\Format::Decimal($row['total']) }}</x-Ui::table.cell-link>

                            <x-Ui::table.cell-link :href="$link"
                                                   right>{{  Aaran\Assets\Helper\Format::Decimal($row['total']/$row['stock_qty']) }}</x-Ui::table.cell-link>

                        </x-Ui::table.row>
                    @endif

                @empty
                    <x-Ui::table.row>
                        <x-Ui::table.cell-text colspan="10" class="text-center text-gray-500">
                            No stock data available.
                        </x-Ui::table.cell-text>
                    </x-Ui::table.row>
                @endforelse
            </x-slot:table_body>
        </x-Ui::table.form>

        <table class="bg-white text-black table-auto w-full text-left border-collapse">
            <tbody>

            @forelse($item_price as $row)
                @if(isset($row['item_code']))
                    <tr>
                        <td class="border-b p-2 bg-white text-gray-500">{{ $row['price_list'] }}</td>
                        <td class="border-b p-2 bg-white text-black">
                            {{ Aaran\Assets\Helper\Format::rupeesFormat($row['price_list_rate']) }}
                        </td>
                    </tr>
                @endif

            @empty
                <x-Ui::table.row>
                    <x-Ui::table.cell-text colspan="10" class="text-center text-gray-500">
                        No stock data available.
                    </x-Ui::table.cell-text>
                </x-Ui::table.row>

            @endforelse
            </tbody>
        </table>

    </x-Ui::forms.m-panel>
</div>
