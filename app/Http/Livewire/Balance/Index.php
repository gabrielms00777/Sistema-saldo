<?php

namespace App\Http\Livewire\Balance;

use App\Models\Balance;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['balance::updated' => '$refresh'];

    public function render()
    {
        // dd(auth()->user()->balance);
        return view('livewire.balance.index', [
            'amount' => auth()->user()->balance->amount ?? 0
        ]);
    }
}
