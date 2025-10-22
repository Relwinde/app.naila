<?php

namespace App\Livewire\Caisse\Modals;

use App\Models\Depot;
use App\Models\Caisse;
use App\Models\MouvementCaisse;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreateDepot extends ModalComponent
{

    public $motif;
    public $montant;
    public $deposant;

    public function render()
    {
        return view('livewire.caisse.modals.create-depot');
    }

    public function create (){
        $this->validate([
            'motif' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0.01',
            'deposant' => 'required|string|max:255',
        ], 
        [
                'motif.required' => 'Le motif est obligatoire.',
                'montant.required' => "Le montant est obligatoire.",
                'montant.numeric' => "Le montant doit être un nombre valide.",
                'montant.min' => "Le montant doit être au moins de 0.01.",
                'deposant.required' => "Le nom du déposant est obligatoire.",
        ]);

        // Création du dépôt
        $depot = Depot::make([
            'motif' => mb_strtoupper($this->motif, 'UTF-8'),
            'montant' => $this->montant,
            'deposant' => mb_strtoupper($this->deposant, 'UTF-8'),
            'user_id' => auth()->user()->id,
        ]);

        try {
            DB::beginTransaction();
            $depot->save();

            $caisse = Caisse::first();
            // Mise à jour du solde de la caisse
            $solde_before = $caisse->solde;

            $caisse->increment('solde', $this->montant);
            $caisse->save();

            $solde_after = $caisse->solde;

            // Enregistrement du mouvement de caisse

            $mouvement_caisse = MouvementCaisse::make([
                'depot_id' => $depot->id,
                'solde_before' => $solde_before,
                'solde_after' => $solde_after,
                'montant' => $this->montant,
                'user_id' => auth()->user()->id,
            ]);

            $mouvement_caisse->save();

            DB::commit();
            $this->dispatch('depot-created');
            $this->reset();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            $this->dispatch('error');
        }
    }
}
