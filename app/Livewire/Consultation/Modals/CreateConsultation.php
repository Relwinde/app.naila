<?php

namespace App\Livewire\Consultation\Modals;

use App\Models\Consultation;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class CreateConsultation extends ModalComponent
{

    public $nom;
    public $description;
    public $prix;

    public function render()
    {
        return view('livewire.consultation.modals.create-consultation');
    }

    public function create (){

        $this->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
        ], [
            'nom.required' => 'Le nom de la consultation est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'prix.required' => "Le prix est obligatoire.",
            'prix.numeric' => "Le prix doit être un nombre valide.",
            'prix.min' => "Le prix ne peut pas être négatif.",
        ]);

        // Logic to create the consultation goes here
        $consultation = Consultation::make([
            'nom' => mb_strtoupper($this->nom, 'UTF-8'),
            'description' => $this->description,
            'prix' => $this->prix,
        ]);
        try{
            DB::beginTransaction();

            $consultation->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error');
        }

        $this->dispatch('prestation-created');
        $this->reset();
        
    }
}
