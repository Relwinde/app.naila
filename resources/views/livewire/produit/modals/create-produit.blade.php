<div>
        <form wire:submit.prevent="create">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Nouveau Produit</h3>
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
                                    <input wire:model='name' type="text" class="form-control form-control-alt" id="nom" name="nom" placeholder="Nom du produit..">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="price">Prix</label>
                                    <input wire:model='price' type="number" class="form-control form-control-alt" id="price" name="price" placeholder="Prix unitaire..">
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="block-form1-password">Quantité</label>
                                    <input wire:model='stock_quantity' type="number" class="form-control form-control-alt" id="stock_quantity" name="stock_quantity" placeholder="Quantité..">
                                    @error('stock_quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea wire:model='description' class="w-100 form-control form-control-alt" id="description" name="description" rows="4" placeholder="Entrez une description.."></textarea>
                                    @error('description')
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
