<x-layout>

    <!-- testo principale -->
    <section class="container-fluid my-5 py-5 ">
        <div class="row justify-content-center my-5">
            <div class="col-12 col-md-12">
                <h2 class="text-center">{{ $title }}</h2>
                <h4 class="text-center">{{ $description }}</h4>
            </div>
        </div>
    </section>
    <!-- fine testo -->

    <main class="container-fluid">
        <div class="row">
            <x-sidebar type="offer" :subcategories="$subcategories" />  
            <div class="col-12 col-md-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($items as $offerta)
                        <div class="col">
                            @if ($offerta->katana)
                                {{-- Passiamo l'oggetto katana al componente --}}
                                <x-cards :katana="$offerta->katana" :discount="$offerta->prezzo_scontato"/>
                                
                            @elseif($offerta->martialArt)
                                {{-- Passiamo l'oggetto arte marziale, ma il componente lo chiamerà comunque "katana" internamente --}}
                                <x-cards :katana="$offerta->martialArt" :discount="$offerta->prezzo_scontato"/>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</x-layout>
