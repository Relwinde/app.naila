<?php

namespace App\Livewire\Pharmacie\Modals;


use LivewireUI\Modal\ModalComponent;

class CreateVente extends ModalComponent
{
    public function render()
    {
        return view('livewire.pharmacie.modals.create-vente');
    }
}
