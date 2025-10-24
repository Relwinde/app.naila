<div>
    <form wire:submit.prevent="create">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Nouvel Agent</h3>
                <div class="block-options">
                    <button wire:click.prevent="create" type="submit" class="btn btn-sm btn-primary">
                        Enregistrer
                    </button>
                    <div wire:loading class=" spinner-border spinner-border-sm text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <button type="reset" wire:click='$dispatch("closeModal")' class="btn btn-sm btn-alt-primary">
                        Annuler
                    </button>
                </div>
            </div>
            <div class="block-content">
                <div class="justify-content-center py-sm-3 py-md-5">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input wire:model='nom' type="text" class="form-control form-control-alt" id="nom" name="nom" placeholder="Nom de l'agent..">
                                @error('nom')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="block-form1-password">Prénom</label>
                                <input wire:model='prenom' type="text" class="form-control form-control-alt" id="block-form1-password" name="prenom" placeholder="Prénom de l'agent..">
                                @error('prenom')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Rôle</label>
                                <select class="form-control" id="role" name="role" wire:model='role'>
                                    <option value="">Selectionnez un rôle</option>
                                    <option value="spécialiste">Spécialiste</option>
                                    <option value="médécin">Médécin</option>
                                    <option value="infirmier">Infirmier</option>
                                    <option value="technicien">Technicien</option>
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
