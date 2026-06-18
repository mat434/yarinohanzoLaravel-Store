<x-layout>

    <section class="container-fluid my-5 py-5">
        <div class="row my-2 justify-content-start align-items-center">
            <div class="col-12 col-md-6">
                {{-- carousel --}}
                <div id="carouselExampleIndicators" class="carousel slide caroarticle">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        {{-- Prima slide con l'immagine principale dal DB --}}
                        <div class="carousel-item active">
                            <img src="{{ asset($item->img) }}" class="d-block w-100" alt="{{ $item->nome }}">
                        </div>
                        {{-- Seconda slide di esempio (o alternativa se hai più immagini) --}}
                        <div class="carousel-item">
                            <img src="{{ asset($item->img) }}" class="d-block w-100" style="filter: grayscale(30%);"
                                alt="{{ $item->nome }} - Dettaglio">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                {{-- fine carousel --}}
            </div>

            <div class="col-12 col-md-6 text-end">
                {{-- Titolo Dinamico --}}
                <h3 class="fw-bold">{{ $item->nome }}</h3>
                {{-- Descrizione Dinamica --}}
                <p class="mt-3 text-muted">
                    {{ $item->descrizione ?? 'Nessuna descrizione disponibile per questo articolo.' }}
                </p>
            </div>
        </div>
    </section>
    <section class="container-fluid mb-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <h5 class="fw-bold mb-3">Specifiche Tecniche</h5>
                <ul class="list-group shadow-sm">
                    {{-- Mostra l'acciaio solo se esiste nel DB (Katane) --}}
                    @if ($item->acciaio)
                        <li class="list-group-item"><strong>Tipo di Acciaio:</strong> {{ $item->acciaio }}</li>
                    @endif

                    {{-- Mostra le misure della lama solo se presenti --}}
                    @if ($item->lunghezzalama)
                        <li class="list-group-item"><strong>Lunghezza Lama:</strong> {{ $item->lunghezzalama }} cm</li>
                    @endif

                    @if ($item->larghezzalama)
                        <li class="list-group-item"><strong>Larghezza Lama:</strong> {{ $item->larghezzalama }} mm</li>
                    @endif

                    @if ($item->lunghezzatsuka)
                        <li class="list-group-item"><strong>Lunghezza Tsuka:</strong> {{ $item->lunghezzatsuka }} cm
                        </li>
                    @endif

                    {{-- Mostra il materiale solo se esiste (Abbigliamento/Bokken) --}}
                    @if ($item->materiale)
                        <li class="list-group-item"><strong>Materiale:</strong> {{ $item->materiale }}</li>
                    @endif

                    <li class="list-group-item text-muted"><small>Codice Prodotto: #00{{ $item->id }}</small></li>
                </ul>
            </div>

            <div class="col-12 col-md-6 my-2 text-end d-flex flex-column justify-content-center align-items-end">
                <ul class="ulpay list-unstyled">
                    {{-- Prezzo Dinamico --}}
                    <li class="fs-3 fw-bold text-danger my-2">
                        {{ number_format($item->prezzo_scontato ?? $item->prezzo, 2, ',', '.') }} €
                    </li>
                </ul>
                {{-- button acquista e carrello --}}
                <form action="{{ route('cart.add') }}" method="POST"
                    class="d-flex flex-column align-items-end w-100 stylebutton">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    {{-- Identifichiamo il tipo: se ha l'acciaio è una katana, altrimenti un articolo marziale --}}
                    <input type="hidden" name="type" value="{{ $item->acciaio ? 'katana' : 'martial' }}">
                    <input type="hidden" name="nome" value="{{ $item->nome }}">
                    <input type="hidden" name="prezzo" value="{{ $item->prezzo_scontato ?? $item->prezzo }}">
                    <input type="hidden" name="img" value="{{ $item->img }}">

                    {{-- Pulsante Standard: Aggiunge e resta sulla pagina --}}
                    <button type="submit" class="btn btn-warning btn-lg fw-bold shadow-sm px-4 mb-2 w-50">
                        <i class="bi bi-cart-plus"></i> Aggiungi al carrello
                    </button>

                    {{-- Pulsante Acquista Ora: Sfrutta 'formaction' per andare alla rotta rapida --}}
                    <button type="submit" formaction="{{ route('cart.buynow') }}"
                        class="btn btn-danger btn-lg fw-bold shadow-sm px-4 w-50">
                        <i class="bi bi-lightning-fill"></i> Acquista Ora
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- section recensioni --}}
    <div class="container mt-5">
        <hr class="my-5">
        <h3 class="fw-bold text-uppercase mb-4" style="font-family: 'Oswald', sans-serif;">Recensioni del Prodotto</h3>

        @php
            // Estraiamo il nome del Modello Eloquent (es: ProductKatanas, MartialArts, Offers)
            $modelName = class_basename($reviewSource);

            // Mappiamo il nome del modello in una stringa semplice per il database/controller
            $reviewableType = match ($modelName) {
                'ProductKatanas' => 'katana',
                'MartialArts' => 'martial_arts',
                'Offers' => 'offer',
                default => 'katana',
            };
            $reviewSource = method_exists($item, 'reviews') ? $item : $item->katana ?? ($item->martialArt ?? null);
        @endphp

        @auth
            <div class="card mb-4 shadow-sm border-0 bg-light p-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Lascia la tua recensione</h5>
                    <form id="reviewForm" data-reviewable-id="{{ $reviewSource->id }}" data-reviewable-type="{{ $reviewableType }}">
                        {{-- Inseriamo l'ID del prodotto reale in modo che JavaScript salvi la recensione sul prodotto corretto --}}
                        <div class="mb-3">
                            <label for="reviewRating" class="form-label fw-bold">Il tuo voto:</label>
                            <select class="form-select w-auto" id="reviewRating" required>
                                <option value="5">⭐⭐⭐⭐⭐ (Eccellente)</option>
                                <option value="4">⭐⭐⭐⭐ (Molto Buono)</option>
                                <option value="3">⭐⭐⭐ (Buono)</option>
                                <option value="2">⭐⭐ (Sufficiente)</option>
                                <option value="1">⭐ (Scarso)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="reviewComment" class="form-label fw-bold">Commento:</label>
                            <textarea class="form-control" id="reviewComment" rows="3"
                                placeholder="Racconta la tua esperienza con questa katana (bilanciamento, finiture, acciaio...)" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-dark text-uppercase fw-bold">Invia Recensione</button>
                    </form>

                    <div id="reviewMessage" class="mt-3 d-none alert"></div>
                </div>
            </div>
        @else
            <div class="alert alert-secondary border-0 shadow-sm d-flex align-items-center mb-4">
                <i class="bi bi-info-circle-fill fs-5 me-3 text-dark"></i>
                <div>
                    <a href="{{ route('login') }}" class="fw-bold text-dark text-decoration-underline">Accedi</a> per
                    poter lasciare una recensione su questa lama.
                </div>
            </div>
        @endauth

        <div id="reviewsContainer" class="d-flex flex-column gap-3">
            @if ($reviewSource && method_exists($reviewSource, 'reviews'))
                @forelse($reviewSource->reviews()->latest()->get() as $review)
                    <div class="card shadow-sm border-0 p-2 bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong class="text-uppercase" style="font-family: 'Oswald', sans-serif;">
                                    <i class="bi bi-person-fill me-1"></i>{{ $review->user->name }}
                                </strong>
                                <span class="text-warning">
                                    {{ str_repeat('⭐', $review->rating) }}
                                </span>
                            </div>
                            <p class="mb-0 text-muted mt-2">"{{ $review->comment }}"</p>
                            <div class="text-end mt-2">
                                <small class="text-secondary" style="font-size: 0.75rem;">
                                    Inviata il {{ $review->created_at->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <p id="noReviewsText" class="text-muted italic">Non ci sono ancora recensioni per questo prodotto.
                        Sii il primo a scriverne una!</p>
                @endforelse
            @else
                <p id="noReviewsText" class="text-muted italic">Recensioni non disponibili per questo tipo di
                    articolo.</p>
            @endif
        </div>
    </div>
    {{-- fine section recensioni --}}
</x-layout>
