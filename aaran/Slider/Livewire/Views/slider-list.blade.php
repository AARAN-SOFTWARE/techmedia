<div>
    <x-slot name="header">Slider</x-slot>

    <x-Ui::forms.m-panel>
        <x-Ui::alerts.notification/>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-Ui::forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Caption -------------------------------------------------------------------------------------------->
        <x-Ui::table.caption :caption="'Sliders'">
            {{$list->count()}}
        </x-Ui::table.caption>

        <!-- Table Data ----------------------------------------------------------------------------------------------->

        <x-Ui::table.form>
            <x-slot:table_header>
                <x-Ui::table.header-serial/>
                <x-Ui::table.header-text wire:click.prevent="sortBy('id')" sortIcon="{{$sortAsc}}" :left="true">
                    Name
                </x-Ui::table.header-text>

                <x-Ui::table.header-text sortIcon="none" :left="true">Link name</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Link to</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none">Show</x-Ui::table.header-text>

                <x-Ui::table.header-status/>
                <x-Ui::table.header-action/>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)

                    @php
                        $link = route('slider-quotes', $row->id);
                    @endphp

                    <x-Ui::table.row>
                        <x-Ui::table.cell-link :href="$link">
                            {{$index+1}}
                        </x-Ui::table.cell-link>

                        <x-Ui::table.cell-link :href="$link" left>{{$row->name}}</x-Ui::table.cell-link>

                        <x-Ui::table.cell-link :href="$link" left>{{$row->link_name}}</x-Ui::table.cell-link>

                        <x-Ui::table.cell-link :href="$link" left>{{$row->link_to}}</x-Ui::table.cell-link>

                        <x-Ui::table.cell-status active="{{$row->active_id}}"/>

                        <x-Ui::table.cell-link class="w-6" :href="route('slider-show', $row->id)" left>
                            <x-Ui::icons.icon :icon="'eye'" class="w-8 h-auto block"/>
                        </x-Ui::table.cell-link>


                        <x-Ui::table.cell-action id="{{$row->id}}"/>
                    </x-Ui::table.row>
                @endforeach
            </x-slot:table_body>
        </x-Ui::table.form>

        <!-- Delete Modal --------------------------------------------------------------------------------------------->
        <x-Ui::modal.confirm-delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create/ Edit Popup --------------------------------------------------------------------------------------->

        <x-Ui::forms.create :id="$vid">
            <div class="flex flex-col gap-3">

                <div>
                    <x-Ui::input.floating wire:model="name" label="Slider Name"/>
                    <x-Ui::input.error-text wire:model="name"/>
                </div>

                <x-Ui::input.floating wire:model="link_name" label="link name"/>

                <x-Ui::input.floating wire:model="link_to" label="link to"/>

            </div>
        </x-Ui::forms.create>

    </x-Ui::forms.m-panel>
</div>
