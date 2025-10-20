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
        return view('livewire.produit.produits', ['produits' => $produits]);
    }
}
