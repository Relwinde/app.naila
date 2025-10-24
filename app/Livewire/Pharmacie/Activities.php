<?php

namespace App\Livewire\Pharmacie;

use Livewire\Component;
use App\Models\Activite;
use Livewire\Attributes\On;
use App\Models\VenteProduit;
use Livewire\WithPagination;

class Activities extends Component
{
    public $startDate;
    public $endDate;

    public $sum;

    use WithPagination;

    #[On('vente-created')]
    public function render()
    {
        $query = VenteProduit::query();

        if ($this->startDate) {
            $start_date = \Carbon\Carbon::parse($this->startDate)->startOfDay()->format('Y-m-d H:i:s');
            $query->where('vente_produits.created_at', '>=', $start_date);
        }

        if ($this->endDate) {
            $end_date = \Carbon\Carbon::parse($this->endDate)->endOfDay()->format('Y-m-d H:i:s');
            $query->where('vente_produits.created_at', '<=', $end_date);
        }



        $activities = $query->orderBy('created_at', 'DESC')->paginate(10);

        $this->sum = $activities->sum('prix_vente');

        $pageHeader = [
            'title' => 'Pharmacie',
            'subtitle' => 'Liste des ventes',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Activités']
            ]
        ];

        return view('livewire.pharmacie.activities', ['activities' => $activities, 'pageHeader' => $pageHeader])->layout('components.layouts.app', ['title'=>'Pharmacie'] );
    }


    public function clearFilters(){
        $this->startDate = null;
        $this->endDate = null;
    }
}
