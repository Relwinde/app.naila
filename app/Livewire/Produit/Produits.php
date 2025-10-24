<?php

namespace App\Livewire\Produit;

use App\Models\Produit;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Produits extends Component
{
    use WithPagination;

    public $editMode = false;
    public $produitId;

    public $name;
    public $description;
    public $price;

    public function toggleEditMode($id)
    {
        if ($this->editMode) {
            $this->editMode = false;
            $this->produitId = null;
            $this->reset(['name', 'description', 'price']);
            return;
        }
        else {
            $produit = Produit::find($id);
            if ($produit) {
                $this->editMode = true;
                $this->produitId = $id;
                $this->name = $produit->nom;
                $this->description = $produit->description;
                $this->price = $produit->prix;
            }
        }
    }

    #[On('produit-created')]
    #[On('produit-deleted')]
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

        return view('livewire.produit.produits', ['produits' => $produits, 'pageHeader' => $pageHeader])->layout('components.layouts.app', ['title'=>'Liste des produits'] );
    }

    public function update($id)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ], [
            'name.required' => 'Le nom du produit est obligatoire.',
            'price.required' => "Le prix est obligatoire.",
            'price.numeric' => "Le prix doit être un nombre valide.",
            'price.min' => "Le prix ne peut pas être négatif.",
        ]);

        $produit = Produit::find($id);
        if ($produit) {
            $produit->nom = mb_strtoupper($this->name, 'UTF-8');
            $produit->description = $this->description;
            $produit->prix = $this->price;
            $produit->save();
        }

        $this->editMode = false;
        $this->produitId = null;
    }


    public function delete($id)
    {
        $produit = Produit::find($id);
        if ($produit) {
            $produit->delete();
            $this->dispatch('produit-deleted');
        }
    }
}
