@props(['katana', 'discount' => null, 'offerId' => null, 'type' => 'katana'])

@php
    // ID definito per prodotti normali e offerte
    $idProdotto = $katana->id ?? $katana['id'] ?? null;

    if ($offerId) {
        $urlCorretto = route('offer.show', $offerId);
    } else {
        if ($type === 'martial') {
            $urlCorretto = route('martialArt.show', $idProdotto);
        } else {
            $urlCorretto = route('product.show', $idProdotto);
        }
    }

    // Calcolo prezzo finale
    $prezzoFinale = isset($discount) ? $discount : ($katana['prezzo'] ?? 0);
@endphp

<div class="card h-100 custom-product-card border-0 shadow-sm d-flex flex-column justify-content-between" style="width: 18rem;">
    {{-- Blocco Immagine con badge sconto geometrico --}}
    <div class="position-relative overflow-hidden custom-card-img-container">
        <img src="{{ asset($katana['img']) }}" alt="{{ $katana['nome'] }}" class="card-img-top custom-card-img">
        @if(isset($discount))
            <span class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1 text-uppercase fw-bold custom-discount-badge">
                Offerta
            </span>
        @endif
    </div>
    
    {{-- Corpo della Card --}}
    <div class="card-body d-flex flex-column justify-content-between p-3">
        {{-- Testi superiori --}}
        <div>
            <h5 class="card-title custom-card-title text-uppercase mb-2">
                {{ $katana['nome'] }}
            </h5>
            <p class="card-text text-muted custom-card-text mb-3">
                {{ Str::limit($katana['descrizione'], 75, '...') }}
            </p>
        </div>

        {{-- Prezzo e Pulsanti inferiori (ancorati in basso) --}}
        <div>
            <div class="mb-3 d-flex align-items-baseline gap-2">
                @if (isset($discount))
                    <span class="text-danger fw-bold fs-5">{{ number_format($discount, 2, ',', '.') }}€</span>
                    <span class="text-muted text-decoration-line-through small">{{ number_format($katana['prezzo'], 2, ',', '.') }}€</span>
                @else
                    <span class="text-dark fw-bold fs-5">{{ number_format($katana['prezzo'], 2, ',', '.') }}€</span>
                @endif
            </div>

            <div class="d-flex gap-2">
                <a href="{{ $urlCorretto }}" class="btn btn-dark w-100 text-uppercase fw-bold custom-btn-square py-2 letter-spacing-1">
                    Dettagli
                </a>
                <form action="{{ route('cart.add') }}" method="POST" class="m-0">
                    @csrf
                    <input type="hidden" name="id" value="{{ $idProdotto }}">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="nome" value="{{ $katana['nome'] }}">
                    <input type="hidden" name="prezzo" value="{{ $prezzoFinale }}">
                    <input type="hidden" name="img" value="{{ $katana['img'] }}">

                    <button type="submit" class="btn btn-outline-dark custom-btn-square py-2 px-3" title="Aggiungi al carrello">
                        <i class="bi bi-cart-plus-fill"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>