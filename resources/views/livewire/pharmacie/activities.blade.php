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
                                <button wire:click.prevent="edit({{ $vente->id }})" class="btn btn-sm btn-light" title="Modifier">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button wire:click.prevent="delete({{ $vente->id }})" wire:confirm="Supprimer cette vente ?" class="btn btn-sm btn-light" title="Supprimer">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </button>
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