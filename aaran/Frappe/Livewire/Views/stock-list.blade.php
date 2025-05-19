<div>
    <x-slot name="header">Stock List</x-slot>

    <x-Ui::forms.m-panel>

        <x-Ui::loadings.loading/>

        <x-Ui::alerts.notification/>


        <div class="flex flex-row justify-between items-center gap-6 py-4 print:hidden">
            <div class="w-2/4 flex items-center space-x-2">

                <x-Ui::input.search-bar wire:model.live.debounce.300ms="searches"
                                        wire:keydown.escape="$set('searches', '')" label="Search"/>
                {{--                <x-Ui::input.toggle-filter :show-filters="$showFilters"/>--}}
            </div>

            <div class="flex justify-between">
                <x-Ui::forms.per-page/>
            </div>
        </div>

        {{--        <x-Ui::input.advance-search :show-filters="$showFilters"/>--}}

        <x-Ui::table.form>
            <x-slot:table_header>
                {{--                <x-Ui::table.header-serial/>--}}
                <x-Ui::table.header-text wire:click.prevent="sortBy('item_code')" sortIcon="{{$sortAsc}}" :left="true">
                    code
                </x-Ui::table.header-text>
                <x-Ui::table.header-text wire:click.prevent="sortBy('item_name')" sortIcon="{{$sortAsc}}" :left="true">
                    Item Name
                </x-Ui::table.header-text>
                <x-Ui::table.header-text wire:click.prevent="sortBy('brand')" sortIcon="{{$sortAsc}}" :left="true">
                    Brand
                </x-Ui::table.header-text>
                <x-Ui::table.header-text wire:click.prevent="sortBy('item_group')" sortIcon="{{$sortAsc}}" :left="true">
                    Item group
                </x-Ui::table.header-text>
                {{--                <x-Ui::table.header-text sortIcon="none" :left="true">Warehouse</x-Ui::table.header-text>--}}
                {{--                <x-Ui::table.header-text sortIcon="none" :left="true">Opening Qty</x-Ui::table.header-text>--}}
                {{--                <x-Ui::table.header-text sortIcon="none" :left="true">Opening Val</x-Ui::table.header-text>--}}
                <x-Ui::table.header-text sortIcon="none" :left="true">Balance Qty</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Balance Value</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Value Rate</x-Ui::table.header-text>
            </x-slot:table_header>

            <x-slot:table_body>

                @forelse($list as $row)

                    @php
                        $link = route('stock-show', $row->id);
                    @endphp

                    <x-Ui::table.row>
                        {{--<x-Ui::table.cell-text>{{ $loop->iteration }}</x-Ui::table.cell-text>--}}

                        <x-Ui::table.cell-link :href="$link">{{ $row->item_code }}</x-Ui::table.cell-link>
                        <x-Ui::table.cell-link :href="$link" left>{{ $row->item_name}}</x-Ui::table.cell-link>
                        <x-Ui::table.cell-link :href="$link" left>{{ $row->brand}}</x-Ui::table.cell-link>
                        <x-Ui::table.cell-link :href="$link" left>{{ $row->item_group}}</x-Ui::table.cell-link>
                        {{--                        <x-Ui::table.cell-link :href="$link">{{ $row->warehouse }}</x-Ui::table.cell-link>--}}
                        {{--                        <x-Ui::table.cell-link :href="$link">{{ $row->opening_qty }}</x-Ui::table.cell-link>--}}
                        {{--                        <x-Ui::table.cell-link :href="$link" right>{{ $row->opening_val }}</x-Ui::table.cell-link>--}}
                        <x-Ui::table.cell-link
                            :href="$link">{{ $row->balance_qty ? $row->balance_qty +0 :'-' }}</x-Ui::table.cell-link>
                        <x-Ui::table.cell-link :href="$link"
                                               right>{{  Aaran\Assets\Helper\Format::Decimal($row->balance_val) }}</x-Ui::table.cell-link>
                        <x-Ui::table.cell-link :href="$link"
                                               right>{{  Aaran\Assets\Helper\Format::rupeesFormat($row->valuation_rate) }}</x-Ui::table.cell-link>
                    </x-Ui::table.row>
                @empty
                    <x-Ui::table.row>
                        <x-Ui::table.cell-text colspan="10" class="text-center text-gray-500">
                            No stock data available.
                        </x-Ui::table.cell-text>
                    </x-Ui::table.row>
                @endforelse
            </x-slot:table_body>
        </x-Ui::table.form>

        <div class="pt-5">{{ $list->links('pagination::tailwind') }}</div>

    </x-Ui::forms.m-panel>
</div>
