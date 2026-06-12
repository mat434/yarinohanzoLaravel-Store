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
</x-layout>
