<?php

namespace App\Livewire\Profile\Modals;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;

class CreateProfile extends ModalComponent
{
    public $name;

    public function render()
    {
        return view('livewire.profile.modals.create-profile');
    }

    public function create(){
        $this->validate([
            'name' => 'required|unique:roles,name'
        ], [
            'name.required' => 'Le nom du profil est obligatoire.',
            'name.unique' => 'Ce nom de profil existe déjà.'
        ]);

        $role = Role::make(['name' => $this->name]);

        try {

            DB::beginTransaction();
            $role->save();
            DB::commit();
            $this->emit('profile-created');
            $this->closeModal();

        } catch (\Exception $e) {

            DB::rollBack();
            $this->addError('name', 'Une erreur est survenue lors de la création du profil.');
            return;
            
        }


    }
}
