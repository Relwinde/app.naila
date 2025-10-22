<?php

namespace App\Livewire\Pharmacie;

use Livewire\Component;
use App\Models\Activite;
use Livewire\Attributes\On;
use App\Models\VenteProduit;
use Livewire\WithPagination;

class Activities extends Component
{

    #[On('vente-created')]
    public function render()
    {

        $activities = VenteProduit::orderBy('created_at', 'desc')->paginate(10);

        $pageHeader = [
            'title' => 'Activités',
            'subtitle' => 'Liste des activités',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Activités']
            ]
        ];

        return view('livewire.pharmacie.activities', ['activities' => $activities, 'pageHeader' => $pageHeader]);
    }
}
