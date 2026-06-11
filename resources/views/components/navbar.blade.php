{{-- inizio navbar --}}
<nav class="navbar navbar-expand-lg bg-body-tertiary position-fixed top-0 w-100">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="{{ asset('immagini/logo_logo22.png') }}" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav  ms-auto">
                <li class="nav-item mx-2">
                    <a id="darkicon" class="nav-link active" aria-current="page" href="#"><i
                            class="bi bi-moon-fill"></i></a>
                </li>
                @php
                    // Recuperiamo il carrello e calcoliamo i totali per il menu
                    $cart = session('cart', []);
                    $totalItems = array_sum(array_column($cart, 'quantity'));
                    $totalPrice = array_reduce(
                        $cart,
                        function ($carry, $item) {
                            return $carry + $item['prezzo'] * $item['quantity'];
                        },
                        0,
                    );
                @endphp
                {{-- logica carrello --}}
                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <button class="btn btn-warning position-relative" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bi bi-cart"></i> Carrello
                                {{-- Pallino rosso che compare solo se ci sono articoli --}}
                                @if ($totalItems > 0)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $totalItems }}
                                    </span>
                                @endif
                            </button>

                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end p-3 shadow"
                                style="width: 320px;">
                                @forelse($cart as $key => $details)
                                    <li
                                        class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($details['img']) }}" alt="{{ $details['nome'] }}"
                                                style="width: 40px; height: 40px; object-fit: cover;"
                                                class="me-2 rounded">
                                            <div>
                                                <h6 class="mb-0 text-white text-truncate" style="max-width: 150px;">
                                                    {{ $details['nome'] }}</h6>
                                                <small class="text-light">{{ $details['quantity'] }} x
                                                    {{ number_format($details['prezzo'], 2, ',', '.') }}€</small>
                                            </div>
                                        </div>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="cartKey" value="{{ $key }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </li>
                                @empty
                                    <li><span class="dropdown-item-text text-center text-muted">Il carrello è
                                            vuoto</span></li>
                                @endforelse

                                @if ($totalItems > 0)
                                    <li class="mt-3">
                                        <div class="d-flex justify-content-between fw-bold text-white mb-3">
                                            <span>Totale:</span>
                                            <span>{{ number_format($totalPrice, 2, ',', '.') }}€</span>
                                        </div>
                                        <a href="#" class="btn btn-success w-100 fw-bold">Vai alla Cassa</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
                {{-- fine logica carrello --}}
                @auth
                    <li class="nav-item mx-2">
                        <a href="" class="nav-link"> Ciao {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item mx-2">
                        {{-- Usiamo un piccolo form per il logout --}}
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn nav-link btesc"
                                style="background:none; border:none;">Esci</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('login') }}">Accedi</a>
                    </li>
                @endauth
            </ul>
            <form class="d-flex" action="{{ route('products.search') }}" method="GET" role="search">
                {{-- Il value mantiene la parola scritta anche dopo il caricamento della pagina --}}
                <input class="form-control me-2" type="search" name="searched" placeholder="Cerca nel sito..."
                    aria-label="Search" value="{{ request('searched') }}" />
                <button class="btn btn-outline-secondary" type="submit">Cerca</button>
            </form>
        </div>
    </div>
</nav>
<!-- fine navbar -->
