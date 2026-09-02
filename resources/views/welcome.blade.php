<x-layout>
    
    {{-- inizio header --}}
<header class="container-fluid custom-hero-header">
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-12 text-center">
            {{-- Titolo principale con forte spaziatura --}}
            <h1 class="text-white text-uppercase custom-header-title mb-4">
                Scopri le nostre katane
            </h1>
            
            <div class="d-flex justify-content-center">
                <div class="dropdown">
                    <button class="btn btn-header-minimal dropdown-toggle text-uppercase" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Scegli Categoria
                    </button>
                    
                    <ul class="dropdown-menu shadow custom-dropdown-menu">
                        <li>
                            <a class="dropdown-item text-uppercase" href="{{ route('products.index', ['category' => 'katana']) }}">
                                Katane e accessori
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-uppercase" href="{{ route('products.index', ['category' => 'artimarziali']) }}">
                                Pratica e arti marziali
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-uppercase" href="{{ route('products.index', ['category' => 'offerte']) }}">
                                Offerte e novità
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
{{-- fine header --}}
    

    <!-- section card -->
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center my-5">
                <h2>Articoli più recenti</h2>
            </div>
            @foreach ($items as $item)
                <div class="col-12 col-md-3 d-flex justify-content-center">
                    <x-cards :katana="$item" />
                </div>
            @endforeach
    </section>
    <!-- fine section card -->

<!-- section personalizzakatana -->
    <section class="container-fluid">
        <div class="row justify-content-center">
            <h4 class="text-center mt-5">Personalizza la tua katana</h4>
            <div class="col-12 d-flex justify-content-center my-3">
                <a class="text-center" href="{{ route('personalizzakatana') }}"><img src="{{ asset('caroimg/nobgkatana.png') }}" class="w-50" alt=""></a>
            </div>
        </div>
    </section>
<!-- fine section personalizzakatana -->

{{-- inizio sezione recensioni --}}
<section class="py-5 custom-reviews-section">
    <div class="container">
        <div class="row mb-4 text-center">
            <div class="col">
                <h2 class="fw-bold text-uppercase label-section-title">Cosa dicono i nostri clienti</h2>
                <p class="text-muted sub-section-title">Le ultime impressioni di appassionati e praticanti sulle nostre lame</p>
            </div>
        </div>

        {{-- Le card iniettate dal tuo JS spunteranno qui dentro --}}
        <div id="latestReviewsContainer" class="row g-4 justify-content-center">
            <div class="col-12 text-center py-4" id="reviewsLoader">
                <div class="spinner-border text-dark" role="status">
                    <span class="visually-hidden">Caricamento...</span>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- fine sezione recensioni --}}


    <!-- section story -->
    <section class="container-fluid my-5 py-5">
        <div class="row align-items-center my-1">
            <div class="col-12 col-md-6">
                <h3 class="fw-bold mb-3" style="font-family: 'Oswald', sans-serif;">La nostra storia</h3>
                <p class="text-start text-muted">
                    YariNoHanzo nasce dalla passione per l'arte della spada giapponese e dal desiderio di
                    renderla accessibile senza mai scendere a compromessi sulla qualità. Tutto è iniziato
                    da un piccolo laboratorio, tra lame in allenamento per Iaido e Kendo e la ricerca costante
                    della tecnica di forgiatura più autentica.
                </p>
                <p class="text-start text-muted">
                    Il nome stesso racchiude questa filosofia: "Yari no Hanzo" richiama la figura leggendaria
                    del guerriero-artigiano, capace di unire disciplina e maestria manuale. Ogni katana che
                    esce dal nostro atelier porta con sé questa doppia anima — strumento di pratica per chi si
                    allena, oggetto da custodire per chi colleziona.
                </p>
                <p class="text-start text-muted">
                    Il nostro obiettivo non è solo vendere una lama, ma accompagnare ogni cliente — dal
                    principiante che cerca la prima katana da allenamento, al collezionista che desidera una
                    configurazione su misura — in un percorso fatto di competenza, trasparenza e rispetto per
                    una tradizione che affonda le radici in secoli di storia.
                </p>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{ asset('caroimg/caro3.jpg') }}" class="img-fluid" alt="La storia di YariNoHanzo">
            </div>
        </div>
    </section>

    <!-- section link categorie -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card bg-dark text-white">
                    <img src="{{ asset('categorie/katane e accessori.png') }}" class="card-img" alt="...">
                    <div class="card-img-overlay h-100">
                        <h5 class="card-title text-start category1">Katana e Accessori</h5>
                        <p class="card-text text-start"><a
                                href="{{ route('products.index', ['category' => 'katana']) }}"
                                class="stretched-link">Scopri di più</a></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-dark text-white">
                    <img src="{{ asset('categorie/offerte.png') }}" class="card-img" alt="...">
                    <div class="card-img-overlay h-100">
                        <h5 class="card-title text-center category2">Novità e offerte</h5>
                        <p class="card-text text-center"><a
                                href="{{ route('products.index', ['category' => 'offerte']) }}"
                                class="stretched-link">Scopri di più</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-dark text-white">
                    <img src="{{ asset('categorie/pratica e arti marziali.png') }}" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title text-end category3">pratica, arti marziali</h5>
                        <p class="card-text text-end"><a
                                href="{{ route('products.index', ['category' => 'artimarziali']) }}"
                                class="stretched-link">Scopri di più</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fine section link categorie -->
    <section class="container-fluid  my-5 py-5">
        <div class="row my-1 justify-content-start align-items-center">
            <div class="col-12 col-md-6">
                <img src="{{ asset('caroimg/caro4.jpg') }}" class="img-fluid" alt="Qualità dei materiali YariNoHanzo">
            </div>
            <div class="col-12 col-md-6">
                <h3 class="fw-bold mb-3 text-end" style="font-family: 'Oswald', sans-serif;">Qualità senza compromessi</h3>
                <p class="text-end text-muted">
                    Ogni katana nasce dalla selezione rigorosa dell'acciaio: dal più accessibile 1045 al
                    più performante Tamahagane-style, ogni lega viene scelta in base all'uso che ne farai,
                    che sia pratica quotidiana o collezionismo.
                </p>
                <p class="text-end text-muted">
                    Non ci fermiamo alla lama. Tsuka, tsuba, saya e ogni singolo componente vengono lavorati
                    e assemblati a mano, verificando equilibrio e finitura pezzo per pezzo prima della
                    spedizione — perché una katana si giudica tanto dal taglio quanto dalla sensazione che
                    trasmette in mano.
                </p>
                <p class="text-end text-muted">
                    Questa attenzione ai dettagli è la stessa che mettiamo nel configuratore delle katane
                    personalizzate: ogni componente che scegli — dall'acciaio al colore del sageo — viene
                    trattato con lo stesso standard artigianale delle nostre katane di serie.
                </p>
            </div>
        </div>
    </section>
    <!-- fine section story -->

</x-layout>