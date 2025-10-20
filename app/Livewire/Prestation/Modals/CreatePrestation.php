<?php

namespace App\Livewire\Prestation\Modals;

use LivewireUI\Modal\ModalComponent;

class CreatePrestation extends ModalComponent
{

    public $name;
    public $description;
    public $price;
    public $duration;

    public function render()
    {
        return view('livewire.prestation.modals.create-prestation');
    }
}
