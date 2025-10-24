<?php

namespace App\Livewire\Caisse;

use App\Models\Caisse;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\MouvementCaisse;

class Home extends Component
{
    public $startDate;
    public $endDate;

    use WithPagination;

    #[On('depense-created')]
    #[On('depot-created')]
    public function render()
    {
        $query = MouvementCaisse::query();
        $caisse = Caisse::first();

        if ($this->startDate) {
            $start_date = \Carbon\Carbon::parse($this->startDate)->startOfDay()->format('Y-m-d H:i:s');
            $query->where('mouvement_caisses.created_at', '>=', $start_date);
        }

        if ($this->endDate) {
            $end_date = \Carbon\Carbon::parse($this->endDate)->endOfDay()->format('Y-m-d H:i:s');
            $query->where('mouvement_caisses.created_at', '<=', $end_date);
        }
        $mouvements = $query->orderBy('created_at', 'DESC')->paginate(10);

        $pageHeader = [
            'title' => 'Caisse',
            'subtitle' => 'Mouvement de la caisse',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Caisse']
            ]
        ];

        return view('livewire.caisse.home', ['pageHeader' => $pageHeader, 'mouvements' => $mouvements, 'caisse' => $caisse])->layout('components.layouts.app', ['title'=>'Caisse'] );
    }

    public function clearFilters(){
        $this->startDate = null;
        $this->endDate = null;
    }
}
