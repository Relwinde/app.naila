<div>
    <form wire:submit.prevent="create">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Nouvelle vente</h3>
                <h3 class="block-title">Montant : <span class="text-primary">{{ number_format($montant, 2, ',', ' ') }} FCFA</span></h3>
                <div class="block-options">
                    <button wire:confirm="Êtes-vous sûr de vouloir enregistrer cette vente ?" wire:click.prevent="create" type="submit" class="btn btn-sm btn-primary">
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
                                <select wire:model.live='produit_id' class="form-control form-control-alt" id="produit" name="produit">
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
                                <input wire:model.live='quantite' type="number" class="form-control form-control-alt" id="block-form1-password" name="quantite" placeholder="Quantité..">
                                @error('quantite')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </form>
</div>
