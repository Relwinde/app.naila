<div>
    {{-- Header --}}
    @include('partials.pages.header')

    {{-- Tableau des ventes de produits --}}
    <div class="block block-rounded">
        <div class="block-header d-flex justify-content-between align-items-center">
            <h3 class="block-title">{{ $pageHeader['subtitle'] }}</h3>
            <div class="block-options">
                <button wire:click="$dispatch('openModal', { component: 'pharmacie.modals.create-vente' })" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Nouvelle Vente
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
                @if ($startDate != null || $endDate != null)
                    <div class="col">
                        <div class="form-group">
                            <label for="total-montant">Total ventes :</label>
                            <input type="text" readonly class="form-control" id="total-montant" value="{{ number_format($this->sum ?? 0, 2, ',', ' ') }} FCFA">
                        </div>
                    </div>
                @endif
            </div>
        </div>



        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Montant (FCFA)</th>
                        <th>Auteur vente</th>
                        <th>Date</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $vente)
                    <tr>
                        <td>{{ $vente->produit->nom ?? '—' }}</td>
                        <td>{{ $vente->quantite }}</td>
                        <td>{{ number_format($vente->prix_vente, 2, ',', ' ') }}</td>
                        <td>{{ $vente->user->name ?? '—' }}</td>
                        <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                {{-- <button wire:click.prevent="edit({{ $vente->id }})" class="btn btn-sm btn-light" title="Modifier">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button wire:click.prevent="delete({{ $vente->id }})" wire:confirm="Supprimer cette vente ?" class="btn btn-sm btn-light" title="Supprimer">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucune vente enregistrée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</div>