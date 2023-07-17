<div>
    <x-button label="Transferir" warning icon="exclamation" wire:click="$set('transferModal', true)" />

    <x-modal.card title="Transferir" blur wire:model.defer="transferModal">
        <form wire:submit.prevent='confirm'>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-input label="Usuário" placeholder="Digite o nome ou email" wire:model.lazy='search' />
                <x-input label="Valor" placeholder="Digite o valor da tranferencia" wire:model.lazy='value' />
            </div>

            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                    <x-button flat negative label="Delete" wire:click="delete" />

                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Transferir" wire:click="confirm" />
                    </div>
                </div>
            </x-slot>
        </form>
    </x-modal.card>
</div>
