<?php

namespace App\Http\Livewire\Historic;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.historic.index', [
            'historics' => auth()->user()->historics()->with('userSender')->latest()->paginate(10)
        ]);
    }
}
