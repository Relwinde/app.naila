<div>
    
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
                        <th>Prix de vente (FCFA)</th>
                        <th>Vendu par</th>
                        <th>Date</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $vente)
                        <tr>
                            {{-- PRODUIT --}}
                            <td>
                                @if ($editMode && $venteId === $vente->id)
                                    <select class="form-control" wire:model="produit_id">
                                        <option value="">-- Choisir un produit --</option>
                                        @foreach ($produits as $produit)
                                            <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('produit_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @else
                                    {{ $vente->produit->nom ?? '—' }}
                                @endif
                            </td>

                            {{-- QUANTITÉ --}}
                            <td>
                                @if ($editMode && $venteId === $vente->id)
                                    <input wire:model="quantite" type="number" min="1" class="form-control form-control-alt" />
                                    @error('quantite')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @else
                                    {{ $vente->quantite }}
                                @endif
                            </td>

                            {{-- PRIX --}}
                            <td>
                                @if ($editMode && $venteId === $vente->id)
                                    <input wire:model="prix_vente" type="number" step="0.01" class="form-control form-control-alt" />
                                    @error('prix_vente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @else
                                    {{ number_format($vente->prix_vente, 2, ',', ' ') }}
                                @endif
                            </td>

                            {{-- UTILISATEUR --}}
                            <td>{{ $vente->user->name ?? '—' }}</td>

                            {{-- DATE --}}
                            <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>

                            {{-- ACTIONS --}}
                            <td class="text-center">
                                <div class="btn-group">
                                    {{-- Bouton Modifier / Enregistrer --}}
                                    <button 
                                        @if ($editMode && $venteId === $vente->id)
                                            wire:click.prevent="update({{ $vente->id }})"
                                        @else
                                            wire:click.prevent="toggleEditMode({{ $vente->id }})"
                                        @endif
                                        type="button" 
                                        class="btn btn-sm btn-light" 
                                        data-toggle="tooltip" 
                                        title="Modifier"
                                    >
                                        @if ($editMode && $venteId === $vente->id)
                                            <i class="fa fa-fw fa-check text-success"></i>
                                        @else
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        @endif
                                    </button>

                                    {{-- Bouton Annuler ou Supprimer --}}
                                    @if ($editMode && $venteId === $vente->id)
                                        <button 
                                            wire:click.prevent="toggleEditMode({{ $vente->id }})"
                                            type="button" 
                                            title="Annuler" 
                                            class="btn btn-sm btn-light" 
                                        >
                                            <i class="fa fa-fw fa-times text-danger"></i>
                                        </button>
                                    @else
                                        <a wire:click.prevent="delete({{ $vente->id }})"
                                           title="Supprimer"
                                           wire:confirm="Êtes-vous sûr de vouloir supprimer cette vente ?"
                                           class="btn btn-sm btn-light">
                                            <i class="fa fa-fw fa-times text-danger"></i>
                                        </a>
                                    @endif
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
