<?php

namespace App\Livewire;

use Livewire\Component;

class Agent extends Component
{
    public function render()
    {
        $agents = Agent::all();
        $pageHeader = [
            'title' => 'Agents',
            'subtitle' => 'Liste des agents',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Agents']
            ]
        ];
        return view('livewire.agent', ['agents' => $agents, 'pageHeader' => $pageHeader]);
    }
}
