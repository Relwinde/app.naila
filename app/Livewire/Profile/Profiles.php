<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Profiles extends Component
{

    use WithPagination;


    public function render()
    {
        $profiles = Role::orderBy('name', 'ASC')->paginate(10);

        $pageHeader = [
            'title' => 'Profils',
            'subtitle' => 'Liste des profils',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Profils']
            ]
        ];

        return view('livewire.profile.profiles', ['profiles' => $profiles, 'pageHeader' => $pageHeader])->layout('components.layouts.app', ['title'=>'Liste des profiles'] );
    }
}
