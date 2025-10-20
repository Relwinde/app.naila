<?php

namespace App\Livewire\Pharmacie;

use Livewire\Component;
use App\Models\Activite;
use Livewire\WithPagination;

class Activities extends Component
{
    public function render()
    {

        $activities = Activite::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.pharmacie.activities', ['activities' => $activities]);
    }
}
