<div>
    <form wire:submit.prevent="create">
        <div class="block-header block-header-default">
            <h3 class="block-title">Nouvel approvisionnement</h3>
            <div class="block-options">
                <button wire:confirm="Êtes-vous sûr de vouloir enregistrer cet approvisionnement ?" wire:click.prevent="create" type="submit" class="btn btn-sm btn-primary">
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
                                <label for="produit">Produit</label>
                                <select wire:model='produit_id' class="form-control form-control-alt" id="produit" name="produit">
                                    <option value="">Sélectionnez un produit</option>
                                    @foreach($produits as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                    @endforeach
                                </select>
                                @error('produit_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="block-form1-password">Quantité</label>
                                <input wire:model='quantite' type="number" class="form-control form-control-alt" id="block-form1-password" name="quantite" placeholder="Quantité..">
                                @error('quantite')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="date_approvisionnement">Prix unitaire</label>
                                <input wire:model='prix_unitaire' type="number" class="form-control form-control-alt" id="prix_unitaire" name="prix_unitaire" placeholder="Prix unitaire..">
                                @error('prix_unitaire')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="numero_lot">Numéro de lot</label>
                                <input wire:model='numero_lot' type="text" class="form-control form-control-alt" id="numero_lot" name="numero_lot" placeholder="Numéro de lot..">
                                @error('numero_lot')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="fournisseur">Fournisseur</label>
                                <input wire:model='fournisseur' type="text" class="form-control form-control-alt" id="fournisseur" name="fournisseur" placeholder="Nom du fournisseur..">
                                @error('fournisseur')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="date_approvisionnement">Date</label>
                                <input wire:model='date_approvisionnement' type="date" class="form-control form-control-alt" id="date_approvisionnement" name="date_approvisionnement">
                                @error('date_approvisionnement')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
        </div>


    </form>
</div>
