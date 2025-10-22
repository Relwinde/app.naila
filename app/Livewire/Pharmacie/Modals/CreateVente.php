<?php

namespace App\Livewire\Pharmacie\Modals;


use App\Models\Produit;
use App\Models\VenteProduit;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreateVente extends ModalComponent
{

    public $montant = 0;
    public $produit_id;
    public $quantite = 0;

    public function render()
    {
        $this->montant = floatval($this->quantite) * optional(Produit::find($this->produit_id))->prix;

        $produits = Produit::where('stock_quantity', '>', 0)->get();
        return view('livewire.pharmacie.modals.create-vente', ['produits' => $produits]);
    }

    public function create(){
        $this->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ], [
            'produit_id.required' => 'Le produit est obligatoire.',
            'produit_id.exists' => 'Le produit sélectionné est invalide.',
            'quantite.required' => "La quantité est obligatoire.",
            'quantite.integer' => "La quantité doit être un entier.",
            'quantite.min' => "La quantité doit être au moins de 1.",
        ]);

        $produit = Produit::find($this->produit_id);

        if ($produit) {
            $vente = VenteProduit::make([
                'produit_id' => $this->produit_id,
                'quantite' => $this->quantite,
                'prix_vente' => $this->montant,
                'user_id' => auth()->id(),
            ]);

            try{
                DB::beginTransaction();
                $vente->save();
                $produit->decrement('stock_quantity', $this->quantite);
                $produit->save();
                DB::commit();
                $this->dispatch('vente-created');
                $this->reset();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error');
            }
        }

    }
}
