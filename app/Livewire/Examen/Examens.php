<?php

namespace App\Livewire\Examen;

use App\Models\Examen;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Examens extends Component
{
    use WithPagination;

    public $editMode = false;
    public $examenId;

    public $nom;
    public $description;
    public $prix;

    public function toggleEditMode($id)
    {
        if ($this->editMode) {
            $this->editMode = false;
            $this->examenId = null;
            $this->reset(['nom', 'description', 'prix']);
            return;
        }
        else {
            $examen = Examen::find($id);
            if ($examen) {
                $this->editMode = true;
                $this->examenId = $id;
                $this->nom = $examen->nom;
                $this->description = $examen->description;
                $this->prix = $examen->prix;
            }
        }
    }

    #[On('examen-created')]
    #[On('examen-deleted')]
    #[On('examen-updated')]
    public function render()
    {
        $examens = Examen::orderBy('nom', 'asc')->paginate(10);

        $pageHeader = [
            'title' => 'Examens',
            'subtitle' => 'Liste des examens',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Examens']
            ]
        ];
        return view('livewire.examen.examens', ['examens' => $examens, 'pageHeader' => $pageHeader]);
    }


    public function update($id)
    {
        $this->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ], 
        [
                'nom.required' => 'Le nom est obligatoire.',
                'prix.required' => "Le prix est obligatoire.",
                'prix.numeric' => "Le prix doit être un nombre valide.",
                'prix.min' => "Le prix doit être au moins 0.",
        ]);

        $examen = Examen::find($id);
        if ($examen) {
            $examen->nom = mb_strtoupper($this->nom, 'UTF-8');
            $examen->prix = $this->prix;
            $examen->description = $this->description;

            try{
                $examen->save();
            } catch (\Exception $e) {
                $this->dispatch('error');
            }

            $this->dispatch('examen-updated');
            $this->reset();
            $this->toggleEditMode(null);
        }
    }

    public function delete($id)
    {
        $examen = Examen::find($id);
        if ($examen) {
            $examen->delete();
            $this->dispatch('examen-deleted');
        }
    }
}
