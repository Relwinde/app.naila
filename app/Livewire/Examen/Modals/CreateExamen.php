<?php

namespace App\Livewire\Examen\Modals;

use App\Models\Examen;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreateExamen extends ModalComponent
{
    public $nom;
    public $description;
    public $prix;

    public function render()
    {
        return view('livewire.examen.modals.create-examen');
    }

    public function create (){
        $this->validate([
            'nom' => 'required|string|max:255|unique:examens,nom',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
        ], [
            'nom.required' => "Le nom de l'examen est obligatoire.",
            'nom.unique' => "Un examen avec ce nom existe déjà.",
            'prix.required' => "Le prix est obligatoire.",
            'prix.numeric' => "Le prix doit être un nombre valide.",
            'prix.min' => "Le prix ne peut pas être négatif.",
        ]);

        $examen = Examen::make([
            'nom' => $this->nom,
            'description' => $this->description,
            'prix' => $this->prix,
        ]);

        try{
            DB::beginTransaction();
            $examen->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error');
        }

        $this->dispatch('examen-created');
        $this->reset();
    }
}
