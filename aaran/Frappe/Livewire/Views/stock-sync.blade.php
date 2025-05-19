<div>
    <x-slot name="header">Stock List</x-slot>

    <x-Ui::forms.m-panel>

        <x-Ui::loadings.loading/>

        <x-Ui::alerts.notification/>


        <div class="flex flex-row justify-between items-center gap-6 py-4 print:hidden">
            <div class="w-2/4 flex items-center space-x-2">

                <div class="flex justify-between gap-3.5 w-3xl">
                        <div>Sync form database up to </div>
                        <x-Ui::input.model-date type="date" wire:model="vdate"/>
                        <x-Ui::button.buton label="Sync" wire:click="syncStock"/>
                </div>
            </div>

    </x-Ui::forms.m-panel>
</div>
