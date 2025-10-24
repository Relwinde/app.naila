<div>
    {{-- Header dynamique --}}
    @include('partials.pages.header')
    
    {{-- Tableau des consultations --}}
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">{{ $pageHeader['subtitle'] }}</h3>
            <div class="block-options">
                <button wire:click="$dispatch('openModal', { component: 'consultation.modals.create-consultation' })" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Ajouter une consultation
                </button>
            </div>
        </div>

        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-responsive-md">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Montant (FCFA)</th>
                        <th>Description</th>
                        <th>Date d’ajout</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($consultations as $consultation)
                    <tr>
                        <td class="font-w600 font-size-sm">
                            @if ($editMode && $consultationId === $consultation->id)
                                <input wire:model='nom' type="text" class="form-control form-control-alt" />
                                @error('nom')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror  
                            @else
                                {{ $consultation->nom }}   
                            @endif
                        </td>
                        <td class="font-size-sm">
                            @if ($editMode && $consultationId === $consultation->id)
                                <input wire:model='prix' type="number" class="form-control form-control-alt" />
                                @error('prix')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @else
                                {{ number_format($consultation->prix, 0, ',', ' ') }} FCFA
                            @endif
                        </td>
                        <td class="font-size-sm">

                            @if ($editMode && $consultationId === $consultation->id)
                                <input wire:model='description' type="text" class="form-control form-control-alt" />
                                @error('type')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @else
                                {{ $consultation->description }}
                            @endif
                        
                        </td>
                        <td class="font-size-sm">{{ $consultation->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                @if ($editMode && $consultationId === $consultation->id)
                                    <button wire:click.prevent="update({{ $consultation->id }})" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Enregistrer">
                                        <i class="fa fa-fw fa-check"></i>
                                    </button>
                                    <button wire:click.prevent="toggleEditMode({{ $consultation->id }})" type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Annuler">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                @else
                                    <button wire:click.prevent="toggleEditMode({{ $consultation->id }})" type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Modifier">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <a wire:click.prevent="delete({{ $consultation->id }})"
                                        title="Supprimer"
                                        wire:confirm="Êtes-vous sûr de vouloir supprimer cette consultation ?" type="button" class="btn btn-sm btn-light" data-toggle="tooltip" >
                                        <i class="fa fa-fw fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune consultation trouvée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
</div>
