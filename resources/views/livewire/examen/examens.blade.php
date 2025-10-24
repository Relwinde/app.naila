<div>

    <!-- Page Content -->
    @include('partials.pages.header')

    <!-- Liste des examens -->
    <div class="block block-rounded">

        <div class="block-header">
            <h3 class="block-title">{{ $pageHeader['subtitle'] }}</h3>
            <div class="block-options">
                <button wire:click="$dispatch('openModal', { component: 'examen.modals.create-examen' })" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Ajouter un examen
                </button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter table-responsive-md">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prix (FCFA)</th>
                        <th>Description</th>
                        <th>Date d’ajout</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($examens as $examen)
                    <tr>
                        <td class="font-w600 font-size-sm">
                            @if ($editMode && $examenId === $examen->id)
                                <input wire:model='nom' type="text" class="form-control form-control-alt" />
                                @error('nom')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror  
                            @else
                                {{ $examen->nom }}   
                            @endif
                        </td>
                        <td class="font-size-sm">
                            @if ($editMode && $examenId === $examen->id)
                                <input wire:model='prix' type="number" class="form-control form-control-alt" />
                                @error('prix')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @else
                                {{ number_format($examen->prix, 0, ',', ' ') }} FCFA
                            @endif
                        </td>
                        <td class="font-size-sm">

                            @if ($editMode && $examenId === $examen->id)
                                <input wire:model='description' type="text" class="form-control form-control-alt" />
                                @error('description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @else
                                {{ $examen->description ?? '—' }}
                            @endif
                        </td>
                        <td class="font-size-sm">{{ $examen->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button @if ($editMode && $examenId === $examen->id) wire:click.prevent="update({{ $examen->id }})"
                                    
                                @else
                                    wire:click.prevent="toggleEditMode({{ $examen->id }})"
                                @endif type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Modifier">
                                    @if ($editMode && $examenId === $examen->id)
                                        <i class="fa fa-fw fa-check"></i>
                                    @else
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    @endif
                                </button>
                                @if ($editMode && $examenId === $examen->id)
                                    <button wire:click.prevent="toggleEditMode({{ $examen->id }})"
                                    type="button" title="Annuler" class="btn btn-sm btn-light" data-toggle="tooltip" >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                @else
                                    <a wire:click.prevent="delete({{ $examen->id }})"
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
                        <td colspan="6" class="text-center text-muted">Aucun examen trouvé</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $examens->links() }}
            </div>
        </div>
    </div>
</div>