<?php

namespace App\Livewire\Pharmacie;

use Livewire\Component;
use App\Models\Activite;
use App\Models\VenteProduit;
use Livewire\WithPagination;

class Activities extends Component
{
    public function render()
    {

        $activities = VenteProduit::orderBy('created_at', 'desc')->paginate(10);

        $pageHeader = [
            'title' => 'Pharmacie',
            'subtitle' => 'Liste des ventes',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Activités']
            ]
        ];

        return view('livewire.pharmacie.activities', ['activities' => $activities, 'pageHeader' => $pageHeader]);
    }
}
