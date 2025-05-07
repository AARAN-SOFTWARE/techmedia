<div>
    <x-slot name="header">Stock List</x-slot>

    <x-Ui::forms.m-panel>

        <x-Ui::loadings.loading/>

        <x-Ui::alerts.notification/>


        <div class="flex flex-row justify-between items-center gap-6 py-4 print:hidden">
            <div class="w-2/4 flex items-center space-x-2">

                <x-Ui::input.search-bar wire:model.live="searches"
                                        wire:keydown.escape="$set('searches', '')" label="Search"/>
                <x-Ui::input.toggle-filter :show-filters="$showFilters"/>
            </div>

            <div class="flex justify-between">
                <x-Ui::forms.per-page/>
                <div class="self-center">
                    <x-Ui::button.buton label="Sync" wire:click="syncStock"/>
                </div>
            </div>
        </div>

        <x-Ui::input.advance-search :show-filters="$showFilters"/>

        <x-Ui::table.form>
            <x-slot:table_header>
                <x-Ui::table.header-serial/>
                <x-Ui::table.header-text sortIcon="none" :left="true">Item code</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Item Name</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Warehouse</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Item group</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Opening Qty</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Opening Val</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Balance Qty</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Balance Value</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Value Rate</x-Ui::table.header-text>
            </x-slot:table_header>

            <x-slot:table_body>

                @forelse($list as $index=>$row)
                    <x-Ui::table.row>
                        <x-Ui::table.cell-text>{{ $loop->iteration }}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text>{{ $row->item_code }}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text left>{{ $row['item_name'] ?? '' }}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text>{{ $row['warehouse'] ?? '' }}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text>{{ $row['item_group'] ?? '' }}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text>{{ $row['opening_qty'] ?? 0 }}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text right>{{ $row['opening_val'] ?? 0 }}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text>{{ $row['bal_qty'] ?? 0 }}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text right>{{ $row['bal_val'] ?? 0 }}</x-Ui::table.cell-text>
                        <x-Ui::table.cell-text right>{{ $row['val_rate'] ?? 0 }}</x-Ui::table.cell-text>
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
