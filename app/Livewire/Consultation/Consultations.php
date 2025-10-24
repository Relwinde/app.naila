<?php

namespace App\Livewire\Consultation;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Consultation;
use Livewire\WithPagination;

class Consultations extends Component
{
    use WithPagination;

    public $editMode = false;
    public $consultationId;

    public $nom;
    public $description;
    public $prix;


    public function toggleEditMode($id)
    {
        if ($this->editMode) {
            $this->editMode = false;
            $this->consultationId = null;
            $this->reset(['nom', 'description', 'prix']);
            return;
        }
        else {
            $consultation = Consultation::find($id);
            if ($consultation) {
                $this->editMode = true;
                $this->consultationId = $id;
                $this->nom = $consultation->nom;
                $this->description = $consultation->description;
                $this->prix = $consultation->prix;
            }
        }
    }


    #[On('prestation-created')]
    #[On('prestation-deleted')]
    #[On('prestation-updated')]
    public function render()
    {
        $consultations = Consultation::orderBy('created_at', 'desc')->paginate(10);

        $pageHeader = [
            'title' => 'Consultations',
            'subtitle' => 'Liste des consultations',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Consultations']
            ]
        ];

        return view('livewire.consultation.consultations', ['consultations' => $consultations, 'pageHeader' => $pageHeader])->layout('components.layouts.app', ['title'=>'Liste consultation'] );
    }

    public function update($id)
    {
        $consultation = Consultation::find($id);
        if ($consultation) {
            $consultation->nom = mb_strtoupper($this->nom, 'UTF-8');
            $consultation->description = $this->description;
            $consultation->prix = $this->prix;
            $consultation->save();

            $this->dispatch('consultation-updated');
            $this->reset();
            $this->toggleEditMode(null);
        }
    }

    public function delete($id)
    {
        $consultation = Consultation::find($id);
        if ($consultation) {
            $consultation->delete();
            $this->dispatch('consultation-deleted');
        }
    }

}
