<?php

namespace App\Http\Livewire\Balance;

use Livewire\Component;
use WireUi\Traits\Actions;

class Deposit extends Component
{
    use Actions;

    public bool $depositModal = false;
    public string $value = '';

    protected $rules = [
        'value' => 'required|numeric',
    ];

    public function save()
    {
        $this->validate();

        $balance = auth()->user()->balance()->firstOrCreate([]);

        $response = $balance->deposit($this->value);

        if($response){
            $this->depositModal = false;

            $this->emit('balance::updated');

            $this->dialog()->success(
                $title = 'Deposito feito com sucesso!',
                $description = "O valor de R$ $this->value foi adiconado com sucesso!"
            );

            $this->reset('value');
        }else{
            $this->depositModal = false;

            $this->dialog()->error(
                $title = 'Erro ao depositar !!!',
                $description = 'Tente novamente!'
            );
        }

    }

    public function render()
    {
        return view('livewire.balance.deposit');
    }
}
