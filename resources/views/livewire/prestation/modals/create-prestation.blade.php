<div>
    <form wire:submit.prevent="create">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Nouvelle Prestation</h3>
                <div class="block-options">
                    <button wire:confirm='Êtes vous sûr de vouloir enregistrer cette prestation ?' wire:click.prevent="create" type="submit" class="btn btn-sm btn-primary">
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
                                <label for="type">Type de prestation</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="consultation" name="type" value="consultation" wire:model.live="type">
                                    <label class="form-check-label" for="consultation">Consultation</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="examen" name="type" value="examen" wire:model.live="type">
                                    <label class="form-check-label" for="examen">Examen</label>
                                </div>
                                @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="agent_id">Agent</label>
                                <select class="form-control" id="agent_id" name="agent_id" wire:model='agent_id'>
                                    <option value="">Selectionnez un agent</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->nom }}</option>
                                    @endforeach
                                </select>
                                @error('agent_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="prestation">Prestation</label>


                                @if ($type === "consultation")
                                    <select class="form-control" id="consultation_id" name="consultation_id" wire:model='consultation_id'>
                                        <option value="">Selectionnez une consultation</option>
                                        @foreach($consultations as $consultation)
                                            <option value="{{ $consultation->id }}">{{ $consultation->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('consultation_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                                @if ($type === "examen")
                                    <select class="form-control" id="examen_id" name="examen_id" wire:model='examen_id'>
                                        <option value="">Selectionnez un examen</option>
                                        @foreach($examens as $examen)
                                            <option value="{{ $examen->id }}">{{ $examen->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('examen_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role">Observation</label>
                                <textarea wire:model='observation' class="form-control form-control-alt" id="observation" name="observation" rows="3" placeholder="Entrez une courte observation..."></textarea>
                                @error('observation')
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
