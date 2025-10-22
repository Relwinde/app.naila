<div>
    @include('partials.pages.header')

    <div class="block block-rounded">
        <div class="block-header">
            <div class="row row-deck flex-grow-1">
                    <div class="col-md-6 col-xl-12">
                    <div class="block block-rounded d-flex flex-column">
                        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between">
                            <dl class="mb-0">
                                <dt class="font-size-h2 font-w700">{{ number_format($caisse->solde, 2, ',', ' ') }} FCFA</dt>
                                <dd class="text-muted mb-0">Solde</dd>
                            </dl>
                            <div>
                                {{-- <div class="d-inline-block px-2 py-1 rounded-lg font-size-sm font-w600 text-danger bg-danger-light">
                                    <i class="fa fa-caret-down mr-1"></i>
                                    2.2%
                                </div> --}}
                            </div>
                        </div>
                        <div class="block-content p-1 text-center overflow-hidden">
                            <!-- Sparkline Line: Orders -->
                            {{-- <span class="js-sparkline" data-type="line"
                                    data-points="[33,29,32,37,38,30,34,28,43,45,26,45,49,39]"
                                    data-width="100%"
                                    data-height="70px"
                                    data-chart-range-min="20"
                                    data-line-color="rgba(210, 108, 122, .4)"
                                    data-fill-color="rgba(210, 108, 122, .15)"
                                    data-spot-color="transparent"
                                    data-min-spot-color="transparent"
                                    data-max-spot-color="transparent"
                                    data-highlight-spot-color="#D26C7A"
                                    data-highlight-line-color="#D26C7A"
                                    data-tooltip-suffix="Orders">
                            </span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-header">
            <h3 class="block-title">{{ $pageHeader['subtitle'] }}</h3>
            <div class="block-options">
                <button wire:click="$dispatch('openModal', { component: 'caisse.modals.create-depot' })" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Effectuer un dépot
                </button>
                <button wire:click="$dispatch('openModal', { component: 'caisse.modals.create-depense' })" class="btn btn-sm btn-danger">
                    <i class="fa fa-plus"></i> Effectuer une dépense
                </button>
            </div>
        </div>

        <div class="block-content block-content-full">
            <!-- Contenu de la page Caisse -->

            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Montant (FCFA)</th>
                        <th>Solde Avant</th>
                        <th>Solde Après</th>
                        <th>Auteur</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mouvements as $mouvement)
                    <tr>
                        <td>
                            @if ($mouvement->vente_produit_id !== null)
                                <span class="badge bg-success">Vente</span>
                                
                            @endif
                            @if ($mouvement->activite_id !== null)
                                    <span class="badge bg-success">Prestation</span>
                            @endif
                            @if ($mouvement->depense_id !== null)
                                <span class="badge bg-danger">Dépense</span>
                            @endif
                            @if ($mouvement->depot_id !== null)
                                    <span class="badge bg-primary">Dépôt</span>
                            @endif
                        </td>
                        <td>{{ number_format($mouvement->montant, 2, ',', ' ') }}</td>
                        <td>{{  number_format($mouvement->solde_before, 2, ',', ' ') }}</td>
                        <td>{{  number_format($mouvement->solde_after, 2, ',', ' ') }}</td>
                        <td>{{ $mouvement->user->name ?? '—' }}</td>
                        <td>{{ $mouvement->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Aucune transaction enregistrée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $mouvements->links() }}
            </div>
        </div>

    </div>
</div>
