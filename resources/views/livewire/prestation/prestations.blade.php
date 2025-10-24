<div>
    {{-- Header --}}
    @include('partials.pages.header')

    {{-- Tableau des prestations --}}
    <div class="block block-rounded">
        <div class="block-header d-flex justify-content-between align-items-center table-responsive-md">
            <h3 class="block-title">{{ $pageHeader['subtitle'] }}</h3>
            <div class="block-options">
                <button wire:click="$dispatch('openModal', { component: 'prestation.modals.create-prestation' })" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Nouvelle Prestation
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
                            <label for="total-montant">Total prestations :</label>
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