<div>
    <!-- Page Content -->
   @include('partials.pages.header', $pageHeader ?? ['title' => 'Produits'])

        <!-- Liste des produits -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Liste des Produits</h3>
                <div class="block-options">
                    <button wire:click="$dispatch('openModal', { component: 'produit.modals.create-produit' })" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Ajouter un produit
                    </button>
                </div>
            </div>

            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix (FCFA)</th>
                            <th>Quantité en stock</th>
                            <th>Date d’ajout</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produits as $produit)
                        <tr wire:key="produit-{{ $produit->id }}">
                            <td class="font-w600 font-size-sm">
                                @if ($editMode && $produitId === $produit->id)
                                    <input wire:model='name' type="text" class="form-control form-control-alt" />
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @else
                                    {{ $produit->nom }}
                                @endif
                            </td>
                            <td class="font-size-sm">
                                @if ($editMode && $produitId === $produit->id)
                                    <input wire:model='description' type="text" class="form-control form-control-alt" />
                                    @error('description')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @else
                                    {{ $produit->description ?? '—' }}
                                @endif
                            
                            </td>
                            <td class="font-size-sm">
                                @if ($editMode && $produitId === $produit->id)
                                    <input wire:model='price' type="number" class="form-control form-control-alt" />
                                    @error('price')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @else
                                    {{ number_format($produit->prix, 2, '.', ' ') }} FCFA
                                @endif
                            </td>
                            <td class="font-size-sm">{{ $produit->stock_quantity }}</td>
                            <td class="font-size-sm">{{ $produit->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button @if ($editMode && $produitId === $produit->id) wire:click.prevent="update({{ $produit->id }})"
                                        
                                    @else
                                        wire:click.prevent="toggleEditMode({{ $produit->id }})"
                                    @endif type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Modifier">
                                        @if ($editMode && $produitId === $produit->id)
                                            <i class="fa fa-fw fa-check"></i>
                                        @else
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        @endif
                                    </button>
                                    @if ($editMode && $produitId === $produit->id)
                                        <button wire:click.prevent="toggleEditMode({{ $produit->id }})"
                                        type="button" title="Annuler" class="btn btn-sm btn-light" data-toggle="tooltip" >
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    @else
                                        <a wire:click.prevent="delete({{ $produit->id }})"
                                            title="Supprimer"
                                            wire:confirm="Êtes-vous sûr de vouloir supprimer ce produit ?" type="button" class="btn btn-sm btn-light" data-toggle="tooltip" >
                                            <i class="fa fa-fw fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aucun produit trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $produits->links() }}
                </div>
            </div>
        </div>
</div>