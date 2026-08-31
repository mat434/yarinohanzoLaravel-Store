<x-layout>
    <div class="container my-5 py-5">
        <div class="row darkrow">

            {{-- Sidebar a sinistra --}}
            <div class="col-12 col-md-3 mb-4">
                <div class="nav flex-column nav-pills shadow-sm p-3 rounded custom-sidebar" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <button class="nav-link active text-start fw-bold mb-2" id="v-pills-info-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-info" type="button" role="tab" aria-controls="v-pills-info"
                        aria-selected="true">
                        <i class="bi bi-person-fill me-2"></i> Informazioni Personali
                    </button>
                    <button class="nav-link text-start fw-bold mb-2" id="v-pills-reviews-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-reviews" type="button" role="tab" aria-controls="v-pills-reviews"
                        aria-selected="false">
                        <i class="bi bi-star-fill me-2"></i> Recensioni Fatte
                    </button>
                    <button class="nav-link text-start fw-bold mb-2" id="v-pills-myorders-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-myorders" type="button" role="tab"
                        aria-controls="v-pills-myorders" aria-selected="false">
                        <i class="bi bi-bag-check-fill me-2"></i> I Miei Ordini
                    </button>
                    <button class="nav-link text-start fw-bold mb-2" id="v-pills-orders-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-orders" type="button" role="tab" aria-controls="v-pills-orders"
                        aria-selected="false">
                        <i class="bi bi-shield-shaded me-2"></i> Katane Personalizzate
                    </button>
                    <button class="nav-link text-start fw-bold" id="v-pills-returns-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-returns" type="button" role="tab" aria-controls="v-pills-returns"
                        aria-selected="false">
                        <i class="bi bi-arrow-counterclockwise me-2"></i> Richieste di Reso
                    </button>
                </div>
            </div>

            {{-- Contenuto dinamico a destra --}}
            <div class="col-12 col-md-9">
                <div class="tab-content shadow-sm p-4 rounded border custom-tab-profile" id="v-pills-tabContent">

                    {{-- Sezione 1: Informazioni Personali --}}
                    <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel"
                        aria-labelledby="v-pills-info-tab">
                        <h4 class="fw-bold mb-4" style="font-family: 'Oswald', sans-serif;">Informazioni Personali</h4>
                        <div class="mb-3">
                            <label class="form-label small fw-bold custom-label">Nome Utente</label>
                            <input type="text" class="form-control custom-input" value="{{ $user->name }}"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold custom-label">Indirizzo Email</label>
                            <input type="email" class="form-control custom-input" value="{{ $user->email }}"
                                readonly>
                        </div>
                    </div>

                    {{-- Sezione 2: Recensioni Fatte (Aggiornata Polimorfica) --}}
                    <div class="tab-pane fade" id="v-pills-reviews" role="tabpanel"
                        aria-labelledby="v-pills-reviews-tab">
                        <h4 class="fw-bold mb-4" style="font-family: 'Oswald', sans-serif;">Le Mie Recensioni</h4>
                        @forelse($reviews as $review)
                            <div class="card mb-3 border-0 shadow-sm custom-review-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-warning">
                                            {{ str_repeat('⭐', $review->rating) }}
                                        </span>
                                        <small class="text-secondary custom-date">
                                            Inviata il {{ $review->created_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                    <p class="mb-0 mt-2 custom-comment">"{{ $review->comment }}"</p>
                                    <small class="d-block mt-2 fw-bold text-danger">
                                        Recensione per: {{ $review->reviewable->nome ?? 'Prodotto non trovato' }}
                                        <span
                                            class="text-muted fw-normal custom-type">({{ ucfirst($review->reviewable_type ?? 'prodotto') }})</span>
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted italic custom-empty">Non hai ancora inserito nessuna recensione sul
                                sito.
                            </p>
                        @endforelse
                    </div>


                    {{-- Sezione: I Miei Ordini --}}
                    <div class="tab-pane fade" id="v-pills-myorders" role="tabpanel"
                        aria-labelledby="v-pills-myorders-tab">
                        <h4 class="fw-bold mb-4" style="font-family: 'Oswald', sans-serif;">I Miei Ordini</h4>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('message'))
                            <div class="alert alert-warning">{{ session('message') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @forelse($activeOrders as $order)
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong>Ordine #{{ $order->id }}</strong>
                                        <small class="text-muted">{{ $order->created_at->format('d/m/Y') }}</small>
                                    </div>
                                    <p class="mb-2 text-muted">{{ $order->items->count() }} articolo/i — Totale:
                                        {{ number_format($order->total_price, 2, ',', '.') }}€</p>

                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-dark"
                                            data-bs-toggle="modal" data-bs-target="#detailsModal{{ $order->id }}">
                                            Dettagli
                                        </button>

                                        @if ($order->canRequestReturn())
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#returnModal{{ $order->id }}">
                                                Richiedi Reso
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Dettagli --}}
                            <div class="modal fade" id="detailsModal{{ $order->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Dettagli Ordine #{{ $order->id }}</h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Indirizzo:</strong> {{ $order->indirizzo }}</p>
                                            <ul class="list-group">
                                                @foreach ($order->items as $item)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $item->nome }} × {{ $item->quantity }}
                                                        <span>{{ number_format($item->prezzo * $item->quantity, 2, ',', '.') }}€</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="mt-3 fw-bold text-end">Totale:
                                                {{ number_format($order->total_price, 2, ',', '.') }}€</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Richiedi Reso --}}
                            @if ($order->canRequestReturn())
                                <div class="modal fade" id="returnModal{{ $order->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content custom-modal-content">
                                            <form action="{{ route('orders.request-return', $order) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Richiedi Reso — Ordine
                                                        #{{ $order->id }}</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <label class="custom-modal-label">Seleziona gli articoli da
                                                        rendere</label>
                                                    @foreach ($order->items as $item)
                                                        <div class="form-check custom-item-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="items[{{ $item->id }}][order_item_id]"
                                                                value="{{ $item->id }}"
                                                                id="item{{ $order->id }}_{{ $item->id }}">
                                                            <label
                                                                class="form-check-label d-flex justify-content-between"
                                                                for="item{{ $order->id }}_{{ $item->id }}">
                                                                <span>{{ $item->nome }} (qtà ordinata:
                                                                    {{ $item->quantity }})</span>
                                                            </label>
                                                            <input type="number"
                                                                name="items[{{ $item->id }}][quantity]"
                                                                class="form-control form-control-sm mt-2"
                                                                style="width:100px" min="1"
                                                                max="{{ $item->quantity }}" value="1">
                                                        </div>
                                                    @endforeach

                                                    <label class="custom-modal-label mt-3">Metodo di reso</label>
                                                    <div class="form-check custom-radio-method">
                                                        <input class="form-check-input" type="radio"
                                                            name="return_method" value="domicilio"
                                                            id="metodo_domicilio{{ $order->id }}" required>
                                                        <label class="form-check-label"
                                                            for="metodo_domicilio{{ $order->id }}">Ritiro a
                                                            domicilio</label>
                                                    </div>
                                                    <div class="form-check custom-radio-method">
                                                        <input class="form-check-input" type="radio"
                                                            name="return_method" value="punto_postale"
                                                            id="metodo_postale{{ $order->id }}" required>
                                                        <label class="form-check-label"
                                                            for="metodo_postale{{ $order->id }}">Punto postale più
                                                            vicino</label>
                                                    </div>

                                                    <label class="custom-modal-label mt-3">Motivo del reso
                                                        (opzionale)
                                                    </label>
                                                    <textarea name="motivo" class="form-control custom-textarea" rows="3" maxlength="1000"
                                                        placeholder="Descrivi il motivo della richiesta..."></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annulla</button>
                                                    <button type="submit" class="btn btn-danger">Invia
                                                        Richiesta</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        @empty
                            <p class="text-muted italic custom-empty">Non hai ancora effettuato nessun ordine.</p>
                        @endforelse
                    </div>

                    {{-- Sezione 3: Katane Personalizzate --}}
                    <div class="tab-pane fade" id="v-pills-orders" role="tabpanel"
                        aria-labelledby="v-pills-orders-tab">
                        <h4 class="fw-bold mb-4" style="font-family: 'Oswald', sans-serif;">Le Mie
                            Configurazioni</h4>

                        @forelse($customKatanas as $katana)
                            <div class="accordion mb-3" id="accordionKatana{{ $katana->id }}">
                                <div class="accordion-item border-0 shadow-sm rounded custom-accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $katana->id }}">
                                        <button class="accordion-button collapsed fw-bold rounded custom-accordion-btn"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $katana->id }}" aria-expanded="false"
                                            aria-controls="collapse{{ $katana->id }}">
                                            <div class="d-flex justify-content-between w-100 me-3">
                                                <span class="text-danger"><i class="bi bi-tools me-2"></i>
                                                    Katana
                                                    Custom
                                                    {{ $katana->name }}</span>
                                                <small class="text-muted custom-date">Configurata il:
                                                    {{ $katana->created_at->format('d/m/Y') }}</small>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $katana->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $katana->id }}"
                                        data-bs-parent="#accordionKatana{{ $katana->id }}">
                                        <div class="accordion-body border-top custom-accordion-body">
                                            <div class="row g-3">
                                                <div class="col-6 col-sm-4"><strong>Nagasa:</strong>
                                                    {{ $katana->nagasa_lenght }}</div>
                                                <div class="col-6 col-sm-4"><strong>Tsuka:</strong>
                                                    {{ $katana->tsuka_lenght }}</div>
                                                <div class="col-6 col-sm-4"><strong>Sori:</strong>
                                                    {{ $katana->sori }}
                                                </div>
                                                <div class="col-6 col-sm-4"><strong>Motohaba:</strong>
                                                    {{ $katana->motohaba }}</div>
                                                <div class="col-6 col-sm-4"><strong>Kitae:</strong>
                                                    {{ $katana->kitae }}
                                                </div>
                                                <div class="col-6 col-sm-4"><strong>Bohi:</strong>
                                                    {{ $katana->bohi }}
                                                </div>
                                                <div class="col-6 col-sm-4"><strong>Tsuba:</strong>
                                                    {{ $katana->tsuba }}
                                                </div>
                                                <div class="col-6 col-sm-4"><strong>Habaki:</strong>
                                                    {{ $katana->habaki }}
                                                </div>
                                                <div class="col-6 col-sm-4"><strong>Seppa:</strong>
                                                    {{ $katana->seppa }}
                                                </div>
                                                <div class="col-6 col-sm-4"><strong>Samegawa:</strong>
                                                    {{ $katana->samegawa }}</div>
                                                <div class="col-6 col-sm-4"><strong>Stile Tsuka:</strong>
                                                    {{ $katana->stile_tsuka }}</div>
                                                <div class="col-6 col-sm-4"><strong>Colore Tsuka:</strong>
                                                    {{ $katana->colore_tsuka }}</div>
                                                <div class="col-6 col-sm-4"><strong>Tipo Saya:</strong>
                                                    {{ $katana->tipo_saya }}</div>
                                                <div class="col-6 col-sm-4"><strong>Colore Sageo:</strong>
                                                    {{ $katana->colore_sageo }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted italic custom-empty">Non hai ancora salvato nessuna
                                configurazione
                                personalizzata.</p>
                        @endforelse
                    </div>


                    {{-- Sezione 4: Richieste di Reso --}}
                    <div class="tab-pane fade" id="v-pills-returns" role="tabpanel"
                        aria-labelledby="v-pills-returns-tab">
                        <h4 class="fw-bold mb-4" style="font-family: 'Oswald', sans-serif;">Richieste di Reso
                        </h4>

                        @forelse($returnRequests as $returnRequest)
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong>Reso #{{ $returnRequest->id }} — Ordine
                                            #{{ $returnRequest->order->id }}</strong>
                                        <span
                                            class="badge bg-warning text-dark">{{ ucfirst(str_replace('_', ' ', $returnRequest->status)) }}</span>
                                    </div>
                                    <p class="mb-1 text-muted small">Richiesto il
                                        {{ $returnRequest->created_at->format('d/m/Y') }}</p>
                                    <ul class="list-group list-group-flush mb-2">
                                        @foreach ($returnRequest->items as $returnItem)
                                            <li class="list-group-item px-0">{{ $returnItem->orderItem->nome }} —
                                                Quantità: {{ $returnItem->quantity }}</li>
                                        @endforeach
                                    </ul>
                                    @if ($returnRequest->motivo)
                                        <p class="mb-0"><strong>Motivo:</strong> {{ $returnRequest->motivo }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-muted italic custom-empty">Nessun reso in corso o disponibile al momento.
                            </p>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.form-check-input[type="checkbox"]').forEach(checkbox => {
            const quantityInput = checkbox.closest('.form-check').querySelector('input[type="number"]');

            quantityInput.disabled = !checkbox.checked;

            checkbox.addEventListener('change', () => {
                quantityInput.disabled = !checkbox.checked;
            });
        });
    </script>
</x-layout>
