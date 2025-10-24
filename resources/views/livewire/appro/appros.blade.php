<div>
    
    @include('partials.pages.header')

    <div class="block block-rounded">
        <div class="block-header d-flex justify-content-between align-items-center">
            <h3 class="block-title">{{ $pageHeader['subtitle'] }}</h3>
            <div class="block-options">
                <button wire:click="$dispatch('openModal', { component: 'appro.modals.create-appro' })" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Nouvel Approvisionnement
                </button>
            </div>
        </div>

        <div class="block-header align-items-left">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="start-date">Date de début :</label>
                        <input wire:model.live="startDate" type="date" class="form-control" id="start-date">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="end-date">Date de fin :</label>
                        <input wire:model.live="endDate" type="date" class="form-control" id="end-date">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="start-date">Réinitialiser :</label>
                        <button type="button" class="btn btn-rounded btn-alt-danger mr-1 mb-3 form-control" wire:click="clearFilters">
                                    <i class="fa fa-fw fa-times mr-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter table-responsive-md">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>N° Lot</th>
                        <th>Prix d'achat</th>
                        <th>Fournisseur</th>
                        <th>Date d'achat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appros as $appro)
                    <tr wire:key="prestation-{{ $appro->id }}">
                        <td class="font-w600 font-size-sm">{{ $appro->produit->nom }}</td>
                        <td class="font-size-sm">{{ $appro->quantite }}</td>
                        <td class="font-size-sm">{{ $appro->numero_lot }}</td>
                        <td class="font-size-sm">{{ $appro->prix_unitaire }}</td>
                        <td class="font-size-sm">{{ $appro->fournisseur }}</td>
                        <td class="font-size-sm">{{ $appro->date_approvisionnement }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Aucune prestation trouvée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $appros->links() }}
            </div>
        </div>
    </div>
<div>
