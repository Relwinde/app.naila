<?php

namespace App\Livewire\Caisse\Modals;

use App\Models\Caisse;
use App\Models\Depense;
use App\Models\MouvementCaisse;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreateDepense extends ModalComponent
{
    public $motif;
    public $montant;

    public function render()
    {
        return view('livewire.caisse.modals.create-depense');
    }


    public function create (){
        $this->validate([
            'motif' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0.01',
        ], 
        [
                'motif.required' => 'Le motif est obligatoire.',
                'montant.required' => "Le montant est obligatoire.",
                'montant.numeric' => "Le montant doit être un nombre valide.",
                'montant.min' => "Le montant doit être au moins de 0.01.",
        ]);

        // Création de la dépense
        $depense = Depense::make([
            'motif' => mb_strtoupper($this->motif, 'UTF-8'),
            'montant' => $this->montant,
            'user_id' => auth()->user()->id,
        ]);

        $caisse = Caisse::first();

        if($caisse->solde < $this->montant){
            $this->dispatch('error', ['message' => "Solde insuffisant dans la caisse pour effectuer cette dépense."]);
            return;
        }

        try{
            DB::beginTransaction();
            $depense->save();
            // Mise à jour du solde de la caisse
            $solde_before = $caisse->solde;
            $caisse->decrement('solde', $this->montant);
            $caisse->save();

            $solde_after = $caisse->solde;
            
            // Enregistrement du mouvement de caisse
            $mouvement_caisse = MouvementCaisse::make([
                'depense_id' => $depense->id,
                'solde_before' => $solde_before,
                'solde_after' => $solde_after,
                'montant' => $this->montant,
                'user_id' => auth()->user()->id,
            ]);

            $mouvement_caisse->save();
            DB::commit();
            $this->dispatch('depense-created');
            $this->reset();
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error');
        }

    }
}
