<x-layout>

    <section class="container-fluid my-5 py-5 ">
        <div class="row justify-content-center my-5">
            <div class="col-12 col-md-12">
                <h2 class="text-center">{{ $title }}</h2>
                <h4 class="text-center">{{ $description }}</h4>
            </div>
        </div>
    </section>
    <main class="container-fluid">
        <div class="row">
            <x-sidebar type="offer" :subcategories="$subcategories" :slug="$slug" />
            <div class="col-12 col-md-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($items as $offerta)
                        <div class="col">
                            @if ($offerta->katana)
                                <x-cards :katana="$offerta->katana" type="katana" :discount="$offerta->prezzo_scontato"
                                    :offerId="$offerta->id" />
                            @elseif($offerta->martialArt)
                                <x-cards :katana="$offerta->martialArt" type="martial" :discount="$offerta->prezzo_scontato"
                                    :offerId="$offerta->id" />
                            @else
                                <x-cards :katana="$offerta" type="offer" :discount="$offerta->prezzo_scontato"
                                    :offerId="$offerta->id" />
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-layout>