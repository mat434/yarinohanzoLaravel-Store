@props(['katana', 'discount' => null, 'offerId' => null, 'type' => 'katana'])

@php
    // 🌟 SPOSTATO QUI FUORI: Così l'ID è SEMPRE definito, sia per i prodotti normali che per le offerte
    $idProdotto = $katana->id ?? $katana['id'] ?? null;

    if ($offerId) {
        // Se è un'offerta, ci pensa la rotta delle offerte
        $urlCorretto = route('offer.show', $offerId);
    } else {
        // Controlliamo 'martial' esattamente come configurato nel PublicController
        if ($type === 'martial') {
            $urlCorretto = route('martialArt.show', $idProdotto);
        } else {
            $urlCorretto = route('product.show', $idProdotto);
        }
    }

    // Calcoliamo il prezzo da mandare al carrello (se c'è lo sconto, passiamo quello)
    $prezzoFinale = isset($discount) ? $discount : ($katana['prezzo'] ?? 0);
@endphp

<div class="card" style="width: 18rem;">
    <img src="{{ asset($katana['img']) }}" alt="{{ $katana['nome'] }}" class="card-img-top" alt="...">
    <div class="card-body px-2">
        <h5 class="card-title">{{ $katana['nome'] }}</h5>
        <p class="card-text">{{ $katana['descrizione'] }}</p>
        <p>{{ $katana['prezzo'] }}€</p>

        {{-- Se passiamo un prezzo scontato, lo mostriamo qui dentro --}}
        @if (isset($discount))
            <p class="text-danger fw-bold">In offerta a {{ $discount }}€ invece di {{ $katana['prezzo'] }}€</p>
        @endif

        <a href="{{ $urlCorretto }}" class="btn btn-success">Acquista</a>
        <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="id" value="{{ $idProdotto }}">
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="nome" value="{{ $katana['nome'] }}">
            <input type="hidden" name="prezzo" value="{{ $prezzoFinale }}">
            <input type="hidden" name="img" value="{{ $katana['img'] }}">

            <button type="submit" class="btn btn-warning">
                <i class="bi bi-cart"></i>
            </button>
        </form>
    </div>
</div>
