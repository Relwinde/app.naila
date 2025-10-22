<div>
   <form wire:submit.prevent="create">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Nouvelle Dépense</h3>
                <div class="block-options">
                    <button wire:confirm="Êtes-vous sûr de vouloir créer cette dépense ?" wire:click.prevent="create" type="submit" class="btn btn-sm btn-primary">
                        Enregistrer
                    </button>
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
                                <label for="nom">Motif</label>
                                <input wire:model='motif' type="text" class="form-control form-control-alt" id="nom" name="nom" placeholder="Motif de la dépense..">
                                @error('motif')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="price">Montant</label>
                                <input wire:model='montant' type="number" class="form-control form-control-alt" id="price" name="price" placeholder="Montant de la dépense..">
                                @error('montant')
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
