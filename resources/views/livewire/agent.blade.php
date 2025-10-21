<div>
    {{-- Header dynamique --}}
    @include('partials.pages.header', $pageHeader)

    {{-- Tableau des agents --}}
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Liste des Agents</h3>
        </div>

        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Rôle</th>
                        <th>Créé le</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($agents as $agent)
                        <tr>
                            <td class="text-center">{{ $agent->id }}</td>
                            <td>{{ $agent->nom }}</td>
                            <td>{{ $agent->prenom }}</td>
                            <td>{{ ucfirst($agent->role) }}</td>
                            <td>{{ $agent->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucun agent enregistré</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            
        </div>
    </div>
</div>
