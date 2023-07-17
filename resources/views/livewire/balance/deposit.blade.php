<div>
    <x-button positive label="Depositar" icon="check" wire:click="$set('depositModal', true)" />

    <x-modal.card title="Depositar" blur wire:model.defer="depositModal">
        <form wire:submit.prevent='save'>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="col-span-1 sm:col-span-2">
                    <x-input label="Valor" placeholder="Digite o valor do deposito" wire:model.defer='value' />
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                    <x-button flat negative label="Delete" wire:click="delete" />

                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="save" />
                    </div>
                </div>
            </x-slot>
        </form>
    </x-modal.card>
</div>
