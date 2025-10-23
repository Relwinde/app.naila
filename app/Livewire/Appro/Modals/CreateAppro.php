<?php

namespace App\Livewire\Appro\Modals;

use App\Models\Produit;
use App\Models\ProduitAppro;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreateAppro extends ModalComponent
{

    public $fournisseur;
    public $produit_id;
    public $quantite;
    public $prix_unitaire;
    public $date_approvisionnement;
    public $numero_lot;
    

    public function render()
    {
        $produits = Produit::all();

        return view('livewire.appro.modals.create-appro', compact('produits'));
    }

    public function create(){
        // Validation des données
        $this->validate([
            'fournisseur' => 'required|string|max:255',
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
            'date_approvisionnement' => 'required|date',
            'numero_lot' => 'nullable|string|max:100',
        ], [
            'fournisseur.required' => 'Le nom du fournisseur est obligatoire.',
            'produit_id.required' => 'Le produit est obligatoire.',
            'produit_id.exists' => 'Le produit sélectionné est invalide.',
            'quantite.required' => 'La quantité est obligatoire.',
            'quantite.integer' => 'La quantité doit être un entier.',
            'quantite.min' => 'La quantité doit être au moins de 1.',
            'prix_unitaire.required' => "Le prix unitaire est obligatoire.",
            'prix_unitaire.numeric' => "Le prix unitaire doit être un nombre.",
            'prix_unitaire.min' => "Le prix unitaire ne peut pas être négatif.",
            'date_approvisionnement.required' => "La date d'approvisionnement est obligatoire.",
            'date_approvisionnement.date' => "La date d'approvisionnement doit être une date valide.",
        ]);

       
        $appro = ProduitAppro::make([
            'fournisseur' => $this->fournisseur,
            'produit_id' => $this->produit_id,
            'quantite' => $this->quantite,
            'prix_unitaire' => $this->prix_unitaire,
            'date_approvisionnement' => $this->date_approvisionnement,
            'numero_lot' => $this->numero_lot,
            'user_id' => auth()->id(),
        ]);

        try{
            DB::beginTransaction();
            
            $produit = $appro->produit;
            if ($produit) {
                $produit->increment('stock_quantity', $this->quantite);
                $produit->save();
            }
            $appro->save();

            DB::commit();

            $this->dispatch('appro-created');
            $this->closeModal();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
}
