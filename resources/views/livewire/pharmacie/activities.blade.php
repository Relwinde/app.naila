<div>
    @include('partials.pages.header', $pageHeader ?? ['title' => 'Activités'])
    
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Liste des Activités</h3>
        </div>

        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Prestation</th>
                        <th>Agent</th>
                        <th>Observations</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $activity)
                        <tr>
                            <td class="text-center">{{ $activity->id }}</td>
                            <td class="font-w600">
                                {{ $activity->prestation->nom ?? '—' }}
                            </td>
                            <td>
                                {{ $activity->agent->nom ?? '—' }}
                            </td>
                            <td>{{ $activity->observations ?? 'Aucune' }}</td>
                            <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucune activité enregistrée</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</div>
