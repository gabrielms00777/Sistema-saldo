<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Saldo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <x-card title="Seu Saldo" color='bg-gray-800 text-white'>
                    R$ {{ $amount }}

                    <div class="flex items-center gap-2 mt-4">
                        <livewire:balance.deposit />
                        <livewire:balance.withdraw />
                        <livewire:balance.transfer />
                    </div>
                    {{-- <x-slot name="footer">
                    </x-slot> --}}
                </x-card>
            </div>
        </div>
    </div>
</div>
