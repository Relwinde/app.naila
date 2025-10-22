<div>
    {{-- Header --}}
    @include('partials.pages.header')

    {{-- Tableau des prestations --}}
    <div class="block block-rounded">
        <div class="block-header d-flex justify-content-between align-items-center">
            <h3 class="block-title">{{ $pageHeader['subtitle'] }}</h3>
            <div class="block-options">
                <button wire:click="$dispatch('openModal', { component: 'prestation.modals.create-prestation' })" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Nouvelle Prestation
                </button>
            </div>
        </div>

        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Agent</th>
                        <th>Date</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prestations as $activite)
                    <tr>
                        <td>{{ $activite->examen?->id ? 'Examen' : 'Consultation' }}</td>
                        <td>{{ $activite->agent?->nom ?? '—' }} {{ $activite->agent?->prenom ?? '' }}</td>
                        <td>{{ $activite->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucune prestation enregistrée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $prestations->links() }}
            </div>
        </div>
    </div>
</div>