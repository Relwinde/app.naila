<?php

namespace App\Livewire\Produit;

use App\Models\Produit;
use Livewire\Component;
use Livewire\WithPagination;

class Produits extends Component
{
    public function render()
    {
        $produits = Produit::orderBy('nom', 'asc')->paginate(10);

        $pageHeader = [
            'title' => 'Produits',
            'subtitle' => 'Liste des produits',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Produits']
            ]
        ];

        return view('livewire.produit.produits', ['produits' => $produits, 'pageHeader' => $pageHeader]);
    }
}
