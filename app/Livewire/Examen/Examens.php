<?php

namespace App\Livewire\Examen;

use App\Models\Examen;
use Livewire\Component;

class Examens extends Component
{
    public function render()
    {
        $examens = Examen::orderBy('nom', 'asc')->paginate(10);
        return view('livewire.examen.examens',['examens' => $examens]);
    }
}
