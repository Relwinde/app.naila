<!-- Modal Création Examen -->
<div class="modal fade" id="createExamenModal" tabindex="-1" aria-labelledby="createExamenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createExamenModalLabel">Ajouter un nouvel examen</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <form action="" method="POST">
                @csrf
                <div class="modal-body">

                    {{-- Nom de l'examen --}}
                    <div class="mb-3">
                        <label for="nom" class="form-label fw-bold">Nom de l'examen <span class="text-danger">*</span></label>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Ex : Analyse sanguine" required>
                    </div>

                    {{-- Prix --}}
                    <div class="mb-3">
                        <label for="prix" class="form-label fw-bold">Prix (FCFA) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="prix" id="prix" class="form-control" placeholder="Ex : 1500" required>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control" placeholder="Entrez une courte description..."></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times me-1"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Enregistrer
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>