<?php

namespace App\Livewire\Agent;

use App\Models\Agent;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Agents extends Component
{
    use WithPagination;

    public $editMode = false;
    public $agentId;

    public $nom;
    public $prenom;
    public $role;

    public function toggleEditMode($id)
    {
        if ($this->editMode) {
            $this->editMode = false;
            $this->agentId = null;
            $this->reset(['nom', 'prenom', 'role']);
            return;
        }
        else {
            $agent = Agent::find($id);
            if ($agent) {
                $this->editMode = true;
                $this->agentId = $id;
                $this->nom = $agent->nom;
                $this->prenom = $agent->prenom;
                $this->role = $agent->role;
            }
        }
    }

    
    #[On('agent-created')]
    #[On('agent-deleted')]
    #[On('agent-updated')]
    public function render()
    {
        $agents = Agent::orderBy('nom', 'asc')->paginate(10);
        $pageHeader = [
            'title' => 'Agents',
            'subtitle' => 'Liste des agents de santé',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Agents']
            ]
        ];
        return view('livewire.agent.agents', ['agents' => $agents, 'pageHeader' => $pageHeader]);
    }

    public function update($id)
    {
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

        $agent = Agent::find($id);
        if ($agent) {
            $agent->nom = mb_strtoupper($this->nom, 'UTF-8');
            $agent->prenom = mb_strtoupper($this->prenom, 'UTF-8');
            $agent->role = $this->role;
            $agent->save();

            $this->dispatch('agent-updated');
            $this->reset();
            $this->toggleEditMode(null);
        }
    }

    public function delete($id)
    {
        $agent = Agent::find($id);
        if ($agent) {
            $agent->delete();
            $this->dispatch('agent-deleted');
        }
    }

}
