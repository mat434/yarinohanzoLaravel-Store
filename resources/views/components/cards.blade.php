@props(['katana', 'discount' => null, 'offerId' => null, 'type' => 'katana'])

@php
    if ($offerId) {
        // Se è un'offerta, ci pensa la rotta delle offerte
        $urlCorretto = route('offer.show', $offerId);
    } else {
        $idProdotto = $katana->id ?? $katana['id'] ?? null;
        
        // 🌟 AGGIORNATO: Controlliamo 'martial' esattamente come configurato nel PublicController
        if ($type === 'martial') {
            $urlCorretto = route('martialArt.show', $idProdotto);
        } else {
            $urlCorretto = route('product.show', $idProdotto);
        }
    }
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
        <a href="{{ $urlCorretto }}" class="btn btn-warning ms-2">
            <i class="bi bi-cart"></i>
        </a>
    </div>
</div>
