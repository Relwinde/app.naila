<div>

    <!-- Page Content -->
    @include('partials.pages.header', $pageHeader ?? ['title' => 'Examens'])

    <!-- Liste des examens -->
    <div class="block block-rounded">

        <div class="block-header">
            <h3 class="block-title">Liste des Examens</h3>
        </div>

        <table class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix (FCFA)</th>
                    <th>Date d’ajout</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($examens as $examen)
                <tr>
                    <td class="text-center font-size-sm">{{ $examen->id }}</td>
                    <td class="font-w600 font-size-sm">{{ $examen->nom }}</td>
                    <td class="font-size-sm">{{ $examen->description ?? '—' }}</td>
                    <td class="font-size-sm">{{ number_format($examen->prix, 0, ',', ' ') }} FCFA</td>
                    <td class="font-size-sm">{{ $examen->created_at->format('d/m/Y') }}</td>
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
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet examen ?')" title="Supprimer">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucun examen trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>