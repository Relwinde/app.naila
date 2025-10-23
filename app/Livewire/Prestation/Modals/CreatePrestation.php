<?php

namespace App\Livewire\Prestation\Modals;

use App\Models\Agent;
use App\Models\Caisse;
use App\Models\Examen;
use App\Models\Activite;
use App\Models\Consultation;
use App\Models\MouvementCaisse;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreatePrestation extends ModalComponent
{
    public $type = null;
    public $observation;
    public $agent_id;
    public $examen_id;
    public $consultation_id;

    public function render()
    {

        $agents = Agent::all();
        $examens = Examen::all();
        $consultations = Consultation::all();

        return view('livewire.prestation.modals.create-prestation', [
            'agents' => $agents,
            'examens' => $examens,
            'consultations' => $consultations
        ]);
    }


    public function create(){
        $this->validate([
            'type' => 'required|in:consultation,examen',
            'observation' => 'nullable|string|max:500',
            // 'agent_id' => 'required|exists:agents,id',
            // 'examen_id' => 'required_if:type,examen|exists:examens,id',
            // 'consultation_id' => 'required_if:type,consultation|exists:consultations,id',
        ],
        [
            'type.required' => 'Le type de prestation est obligatoire.',
            'type.in' => "Le type de prestation doit être 'consultation' ou 'examen'.",
            'agent_id.required' => "L'agent est obligatoire.",
            'agent_id.exists' => "L'agent sélectionné est invalide.",
            'examen_id.required_if' => "L'examen est obligatoire pour le type examen.",
            'examen_id.exists' => "L'examen sélectionné est invalide.",
            'consultation_id.required_if' => "La consultation est obligatoire pour le type consultation.",
            'consultation_id.exists' => "La consultation sélectionnée est invalide.",
        ]);

        $prestation = Activite::make([
            'observations' => $this->observation,
            'montant' => $this->type === 'examen' ? optional(Examen::find($this->examen_id))->prix : ( $this->type === 'consultation' ? optional(Consultation::find($this->consultation_id))->prix : 0 ),
            'agent_id' => $this->agent_id,
            'examen_id' => $this->type === 'examen' ? $this->examen_id : null,
            'consultation_id' => $this->type === 'consultation' ? $this->consultation_id : null,
        ]);

        try{
            DB::beginTransaction();
            $prestation->save();

            $caisse = Caisse::first();

            $solde_before = $caisse->solde;
            if ($this->type === 'examen') {
                $examen = Examen::find($this->examen_id);
                $caisse->solde += $examen->prix;
            } elseif ($this->type === 'consultation') {
                $consultation = Consultation::find($this->consultation_id);
                $caisse->solde += $consultation->prix;
            }
            $solde_after = $caisse->solde;


            $mouvement_caisse = MouvementCaisse::make([
                'activite_id' => $prestation->id,
                'solde_before' => $solde_before,
                'solde_after' => $solde_after,
                'montant' => $solde_after - $solde_before,
                'user_id' => auth()->id(),
            ]);

            $mouvement_caisse->save();
            $caisse->save();
            DB::commit();
            $this->dispatch('prestation-created');
            $this->reset();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
