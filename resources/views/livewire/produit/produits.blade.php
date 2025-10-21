<div>
    <!-- Page Content -->
   @include('partials.pages.header', $pageHeader ?? ['title' => 'Produits'])

    <div class="content">
        <!-- Liste des produits -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Liste des Produits</h3>
                <div class="block-options">
                    <a href="" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Ajouter un produit
                    </a>
                </div>
            </div>

            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">ID</th>
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
                        <tr>
                            <td class="text-center font-size-sm">{{ $produit->id }}</td>
                            <td class="font-w600 font-size-sm">{{ $produit->nom }}</td>
                            <td class="font-size-sm">{{ $produit->description ?? '—' }}</td>
                            <td class="font-size-sm">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</td>
                            <td class="font-size-sm">{{ $produit->stock_quantity }}</td>
                            <td class="font-size-sm">{{ $produit->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-info" title="Voir">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce produit ?')" title="Supprimer">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
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
            </div>
        </div>
    </div>
</div>