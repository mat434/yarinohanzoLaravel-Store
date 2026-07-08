{{-- inizio navbar --}}
<nav class="navbar navbar-expand-lg position-fixed top-0 w-100 custom-navbar z-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('immagini/logo_logo22.png') }}" alt="Logo" style="max-height: 45px;">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center mb-3 mb-lg-0">
                @php
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

                {{-- Logica Carrello --}}
                <li class="nav-item dropdown mx-2">
                    <button class="btn btn-cart-minimal position-relative text-uppercase" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-cart me-1"></i> Carrello
                        @if ($totalItems > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge bg-danger custom-badge">
                                {{ $totalItems }}
                            </span>
                        @endif
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end p-3 shadow custom-dropdown" style="width: 320px;">
                        @forelse($cart as $key => $details)
                            <li class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($details['img']) }}" alt="{{ $details['nome'] }}"
                                        style="width: 40px; height: 40px; object-fit: cover;" class="me-2">
                                    <div>
                                        <h6 class="mb-0 text-dark text-truncate" style="max-width: 150px;">
                                            {{ $details['nome'] }}
                                        </h6>
                                        <small class="text-muted">{{ $details['quantity'] }} x
                                            {{ number_format($details['prezzo'], 2, ',', '.') }}€</small>
                                    </div>
                                </div>
                                <form action="{{ route('cart.remove') }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="cartKey" value="{{ $key }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </li>
                        @empty
                            <li><span class="dropdown-item-text text-center text-muted">Il carrello è vuoto</span></li>
                        @endforelse

                        @if ($totalItems > 0)
                            <li class="mt-3">
                                <div class="d-flex justify-content-between fw-bold text-dark mb-3">
                                    <span>Totale:</span>
                                    <span>{{ number_format($totalPrice, 2, ',', '.') }}€</span>
                                </div>
                                <a href="{{ route('checkout') }}" class="btn btn-success w-100 fw-bold custom-btn-square">Vai alla Cassa</a>
                            </li>
                        @endif
                    </ul>
                </li>
                {{-- Fine Logica Carrello --}}

                @auth
                    {{-- Area Personale --}}
                    <li class="nav-item mx-2">
                        <a href="{{ route('user.profile') }}" class="nav-link fw-bold custom-nav-link">
                            <i class="bi bi-person-circle me-1 text-danger"></i> {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn nav-link custom-nav-link border-0 p-0" style="background:none;">Esci</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item mx-2">
                        <a class="nav-link custom-nav-link" href="{{ route('register') }}">Registrati</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link custom-nav-link" href="{{ route('login') }}">Accedi</a>
                    </li>
                @endauth
            </ul>

            {{-- Barra di ricerca --}}
            <form class="d-flex ms-lg-3" action="{{ route('products.search') }}" method="GET" role="search">
                <input class="form-control custom-search-input" type="search" name="searched" placeholder="Cerca..."
                    aria-label="Search" value="{{ request('searched') }}" />
                <button class="btn btn-search-minimal" type="submit">Cerca</button>
            </form>
        </div>
    </div>
</nav>
{{-- fine navbar --}}