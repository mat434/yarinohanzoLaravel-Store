<x-layout>
    <div class="container" style="margin-top: 100px;">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Risultati della ricerca per: <span class="text-warning">"{{ $searched }}"</span></h2>
            </div>
        </div>

        <div class="row g-4">
            {{-- 🌟 1. Ciclo Offerte (Kaizen, Shogun, ecc.) --}}
            @foreach($offers as $offer)
                <div class="col-12 col-md-4 col-lg-3">
                    {{-- Passiamo l'id dell'offerta e il prezzo scontato se lo hai nel database (es. $offer->prezzo_scontato o simile) --}}
                    <x-cards :katana="$offer" :offerId="$offer->id" :discount="$offer->prezzo_scontato ?? null" type="katana" />
                </div>
            @endforeach

            {{-- 2. Ciclo Katane / Prodotti Generici --}}
            @foreach($products as $product)
                <div class="col-12 col-md-4 col-lg-3">
                    <x-cards :katana="$product" type="katana" />
                </div>
            @endforeach

            {{-- 3. Ciclo Articoli Marziali --}}
            @foreach($martialArts as $martial)
                <div class="col-12 col-md-4 col-lg-3">
                    <x-cards :katana="$martial" type="martial" />
                </div>
            @endforeach

            
            @if($products->isEmpty() && $martialArts->isEmpty() && $offers->isEmpty())
                <div class="col-12 text-center my-5">
                    <i class="bi bi-emoji-frown" style="font-size: 3rem; color: #6c757d;"></i>
                    <p class="mt-3 text-muted">Nessun prodotto corrisponde alla tua ricerca. Riprova con un altro termine!</p>
                </div>
            @endif
        </div>
    </div>
</x-layout>