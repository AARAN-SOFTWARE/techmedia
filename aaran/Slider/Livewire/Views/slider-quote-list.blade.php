<div>
    <x-slot name="header">Slider Quotes</x-slot>

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
                <x-Ui::table.header-text sortIcon="none" :left="true">Header</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Tagline</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Tagline 2</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Back colour</x-Ui::table.header-text>
                <x-Ui::table.header-text sortIcon="none" :left="true">Text colour</x-Ui::table.header-text>

                <x-Ui::table.header-status/>
                <x-Ui::table.header-action/>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)

                    @php
                        $link = route('slider-show', $row->id);
                    @endphp

                    <x-Ui::table.row>
                        <x-Ui::table.cell-link :href="$link">
                            {{$index+1}}
                        </x-Ui::table.cell-link>

                        <x-Ui::table.cell-link :href="$link" left>{{$row->header}}</x-Ui::table.cell-link>

                        <x-Ui::table.cell-link :href="$link" left>{{$row->tagline}}</x-Ui::table.cell-link>

                        <x-Ui::table.cell-link :href="$link" left>{{$row->tagline_2}}</x-Ui::table.cell-link>

                        <x-Ui::table.cell-link :href="$link" left>{{$row->bg_colour}}</x-Ui::table.cell-link>

                        <x-Ui::table.cell-link :href="$link" left>{{$row->txt_colour}}</x-Ui::table.cell-link>

                        <x-Ui::table.cell-status active="{{$row->active_id}}"/>

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

                <x-Ui::input.floating wire:model="header" label="Header"/>

                <x-Ui::input.floating wire:model="bg_colour" label="Back colour"/>

                <x-Ui::input.floating wire:model="txt_colour" label="Text colour"/>

                <x-Ui::input.floating wire:model="fill_colour" label="Fill colour"/>

                <x-Ui::input.floating wire:model="tagline" label="tagline"/>

                <x-Ui::input.floating wire:model="tagline_2" label="tagline_2"/>

            </div>

        </x-Ui::forms.create>


    </x-Ui::forms.m-panel>
</div>
