<?php

namespace App\Livewire\Appro;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProduitAppro;
use Livewire\WithPagination;

class Appros extends Component
{
    use WithPagination;

    public $startDate;
    public $endDate;

    #[On('appro-created')]
    public function render()
    {
        $query = ProduitAppro::query();

        if ($this->startDate) {
            $start_date = \Carbon\Carbon::parse($this->startDate)->startOfDay()->format('Y-m-d H:i:s');
            $query->where('produit_appros.created_at', '>=', $start_date);
        }

        if ($this->endDate) {
            $end_date = \Carbon\Carbon::parse($this->endDate)->endOfDay()->format('Y-m-d H:i:s');
            $query->where('produit_appros.created_at', '<=', $end_date);
        }

        $appros = $query->orderBy('created_at', 'DESC')->paginate(10);

        $pageHeader = [
            'title' => 'Approvisionnements',
            'subtitle' => 'Liste des approvisionnements',
            'breadcrumbs' => [
                ['label' => 'Accueil', 'url' => route('home')],
                ['label' => 'Approvisionnements']
            ]
        ];

        return view('livewire.appro.appros', ['appros' => $appros, 'pageHeader' => $pageHeader]);
    }

    public function clearFilters(){
        $this->startDate = null;
        $this->endDate = null;
    }
}
