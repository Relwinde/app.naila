<?php

namespace App\Livewire\Prestation;

use App\Models\Activite;
use Livewire\Component;

class Prestations extends Component
{
    public function render()
    {
        $prestations = Activite::orderBy('created_at', 'desc')->paginate(10);

        $pageHeader = [
            'title' => 'Prestations',
            'subtitle' => 'Liste des prestations',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Prestations']
            ]
        ];

        return view('livewire.prestation.prestations', ['prestations' => $prestations, 'pageHeader' => $pageHeader]);
    }
}
