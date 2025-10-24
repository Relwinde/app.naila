<?php

namespace App\Livewire\Prestation;

use Livewire\Component;
use App\Models\Activite;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Prestations extends Component
{

    use WithPagination;

    public $startDate;
    public $endDate;

    public $sum;

    #[On('prestation-created')]
    public function render()
    {
        $query = Activite::query();
        if ($this->startDate) {
            $start_date = \Carbon\Carbon::parse($this->startDate)->startOfDay()->format('Y-m-d H:i:s');
            $query->where('activites.created_at', '>=', $start_date);
        }

        if ($this->endDate) {
            $end_date = \Carbon\Carbon::parse($this->endDate)->endOfDay()->format('Y-m-d H:i:s');
            $query->where('activites.created_at', '<=', $end_date);
        }

        $prestations = $query->orderBy('created_at', 'DESC')->paginate(10);
        $this->sum = $prestations->sum('montant');

        $pageHeader = [
            'title' => 'Prestations',
            'subtitle' => 'Liste des prestations',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Prestations']
            ]
        ];

        return view('livewire.prestation.prestations', ['prestations' => $prestations, 'pageHeader' => $pageHeader])->layout('components.layouts.app', ['title'=>'Liste des prestations'] );
    }

    public function clearFilters(){
        $this->startDate = null;
        $this->endDate = null;
    }
}
