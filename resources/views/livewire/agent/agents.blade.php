<div>
    {{-- Header dynamique --}}
    @include('partials.pages.header')

    {{-- Tableau des agents --}}
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">{{ $pageHeader['subtitle'] }}</h3>
            <div class="block-options">
                <button wire:click="$dispatch('openModal', { component: 'agent.modals.create-agent' })" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Ajouter un agent
                </button>
            </div>
        </div>

        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter table-responsive-md">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Rôle</th>
                        <th>Date de création</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($agents as $agent)
                        <tr>
                            <td>
                                @if ($editMode && $agentId === $agent->id)
                                    <input wire:model='nom' type="text" class="form-control form-control-alt" />
                                    @error('nom')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @else
                                    {{ $agent->nom }}   
                                @endif
                            
                            </td>
                            <td>
                                @if ($editMode && $agentId === $agent->id)
                                    <input wire:model='prenom' type="text" class="form-control form-control-alt" />
                                    @error('prenom')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror 
                                @else
                                    {{ $agent->prenom }}
                                @endif
                            
                            </td>
                            <td>
                                @if ($editMode && $agentId === $agent->id)
                                    <select class="form-control" wire:model='role'>
                                        <option value="">Selectionnez un rôle</option>
                                        <option value="spécialiste">Spécialiste</option>
                                        <option value="médécin">Médécin</option>
                                        <option value="infirmier">Infirmier</option>
                                        <option value="technicien">Technicien</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @else
                                    {{ ucfirst($agent->role) }}
                                @endif
                            </td>
                            <td>{{ $agent->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button @if ($editMode && $agentId === $agent->id) wire:click.prevent="update({{ $agent->id }})"
                                        
                                    @else
                                        wire:click.prevent="toggleEditMode({{ $agent->id }})"
                                    @endif type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Modifier">
                                        @if ($editMode && $agentId === $agent->id)
                                            <i class="fa fa-fw fa-check"></i>
                                        @else
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        @endif
                                    </button>
                                    @if ($editMode && $agentId === $agent->id)
                                        <button wire:click.prevent="toggleEditMode({{ $agent->id }})"
                                        type="button" title="Annuler" class="btn btn-sm btn-light" data-toggle="tooltip" >
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    @else
                                        <a wire:click.prevent="delete({{ $agent->id }})"
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
                            <td colspan="5" class="text-center text-muted">Aucun agent enregistré</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $agents->links() }}
            </div>
        </div>
    </div>
</div>
