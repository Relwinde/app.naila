<div>
    @include('partials.pages.header')
    <div class="block block-rounded">
         <div class="block-header">
            <h3 class="block-title">{{ $pageHeader['subtitle'] }}</h3>
            <div class="block-options">
                <button wire:click="$dispatch('openModal', { component: 'user.modals.create-user' })" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Ajouter un utilisateur
                </button>
            </div>
        </div>

        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-responsive-md">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Date d’inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td class="font-w600 font-size-sm">
                            {{ $user->name }}
                        </td>
                        <td class="font-size-sm">
                            {{ $user->email }}
                        </td>
                        <td class="font-size-sm">
                            {{ ucfirst($user->roles()->first()->name) }}
                        </td>
                        <td class="font-size-sm">
                            {{ $user->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="text-center">
                            <button wire:confirm="Êtes-vous sûr de vouloir supprimer cet utilisateur ?" wire:click="delete({{ $user->id }})" class="btn btn-sm btn-alt-danger" title="Supprimer">
                                <i class="fa fa-trash"></i>
                            </button>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Aucun utilisateur trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
            <div class="mt-3">
                {{ $users->links() }}
            </div>

        </div>
    
    </div>
</div>
