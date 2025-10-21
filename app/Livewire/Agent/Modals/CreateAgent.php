<?php

namespace App\Livewire\Agent\Modals;

use App\Models\Agent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreateAgent extends ModalComponent
{

    public $nom;
    public $prenom;
    public $role;

    public function render()
    {
        return view('livewire.agent.modals.create-agent');
    }

    public function create (){
        $this->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'role' => ['required', Rule::in(['médécin', 'infirmier', 'technicien', 'spécialiste'])],
        ], 
        [
                'nom.required' => 'Le nom est obligatoire.',
                'prenom.required' => "Le prénom est obligatoire.",
                'role.required' => "Le rôle est obligatoire.",
                'role.in' => "Le rôle doit être l'un des suivants : médécin, infirmier, technicien, spécialiste.",
        ]);

        $agent = Agent::make([
            'nom' => mb_strtoupper($this->nom, 'UTF-8'),
            'prenom' => mb_strtoupper($this->prenom, 'UTF-8'),
            'role' => $this->role,
        ]);

        try{
            DB::beginTransaction();
            $agent->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error');
        }

        $this->dispatch('agent-created');
        $this->reset();
    }
}
