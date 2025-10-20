<?php

namespace App\Livewire\Examen\Modals;

use App\Models\Examen;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class CreateExamen extends ModalComponent
{
    public function render()
    {
        return view('livewire.examen.modals.create-examen');
    }
}
