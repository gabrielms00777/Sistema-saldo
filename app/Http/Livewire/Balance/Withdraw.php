<?php

namespace App\Http\Livewire\Balance;

use Livewire\Component;
use WireUi\Traits\Actions;

class Withdraw extends Component
{
    use Actions;

    public bool $withdrawModal = false;
    public string $value = '';

    protected $rules = [
        'value' => 'required|numeric',
    ];

    public function save()
    {
        $this->validate();

        $balance = auth()->user()->balance()->firstOrCreate([]);

        $response = $balance->withdraw((float)$this->value);

        if($response){
            $this->withdrawModal = false;

            $this->emit('balance::updated');

            $this->dialog()->success(
                $title = 'Saque feito com sucesso!',
                $description = "O valor de $this->value foi retirado com sucesso!"
            );

            $this->reset('value');
        }else{
            $this->withdrawModal = false;

            $this->dialog()->error(
                $title = 'Erro ao sacar !!!',
                $description = 'Verifique seu saldo e tente novamente!'
            );
        }

    }


    public function render()
    {
        return view('livewire.balance.withdraw');
    }
}
