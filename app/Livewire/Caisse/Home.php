<?php

namespace App\Livewire\Caisse;

use App\Models\Caisse;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\MouvementCaisse;

class Home extends Component
{

    use WithPagination;

    #[On('depense-created')]
    #[On('depot-created')]
    public function render()
    {
        $mouvements = MouvementCaisse::orderBy('created_at', 'desc')->paginate(10);
        $caisse = Caisse::first();

        $pageHeader = [
            'title' => 'Caisse',
            'subtitle' => 'Mouvement de la caisse',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Caisse']
            ]
        ];

        return view('livewire.caisse.home', ['pageHeader' => $pageHeader, 'mouvements' => $mouvements, 'caisse' => $caisse]);
    }
}
