<?php

namespace App\Http\Livewire\Balance;

use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;

class Transfer extends Component
{
    use Actions;

    public bool $transferModal = false;
    public string $search = '';
    public string $value = '';

    public User $sender;

    protected $rules = [
        'search' => 'required|string',
        'value' => 'required|numeric',
    ];

    public function confirm()
    {
        $this->validate();

        $this->sender = User::query()->where('name', 'like', "%$this->search%")
                                ->orWhere('email', $this->search)
                                ->first();


        if(auth()->user()->balance()->first()->amount < $this->value){
            $this->transferModal = false;

            $this->dialog()->error(
                $title = 'Saldo insuficiente!',
                $description = 'Tente novamente.'
            );
        }else if($this->sender->id == auth()->user()->id){
            $this->transferModal = false;

            $this->dialog()->error(
                $title = 'Voçê não pode envar para você mesmo!',
                $description = 'Tente novamente.'
            );
        }else if($this->sender){

            $this->transferModal = false;

            $this->dialog()->confirm([
                'title'       => 'Confirma transferencia?',
                'description' => "Deseja transferir R$ $this->value para {$this->sender->name}?",
                'acceptLabel' => 'Yes, save it',
                'method'      => 'save',
                'params'      => 'Saved',
            ]);
        }else{
            $this->transferModal = false;

            $this->dialog()->error(
                $title = 'Usuário não encontrado!',
                $description = 'Tente novamente.'
            );
        }
    }

    public function save()
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($this->sender, (int)$this->value);

        if($response){
            $this->emit('balance::updated');

            $this->dialog()->success(
                $title = 'Transferencia feita com sucesso!',
                $description = "O valor de R$ $this->value foi transferido com sucesso!"
            );

            $this->reset(['search', 'value']);
        }else{
            $this->dialog()->error(
                $title = 'Erro ao tentar transferir!',
                $description = 'Tente novamente.'
            );
        }
    }

    public function render()
    {
        return view('livewire.balance.transfer');
    }
}
