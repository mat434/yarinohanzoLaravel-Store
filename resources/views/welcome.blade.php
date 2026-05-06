<x-layout>
    <!-- header -->
    <header class="container-fluid">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-12">
                <h4 class="text-center text-white">SCOPRI LE NOSTRE KATANE</h4>
                <div class="d-flex justify-content-center">
                    <div class="dropdown">
                        <button class="btn btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            SCEGLI CATEGORIA
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item text-center" href="#">Tutti i prodotti</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-center"
                                    href="{{ route('products.index', ['category' => 'arti-marziali']) }}">Pratica e arti
                                    marziali</a></li>
                            <li><a class="dropdown-item text-center"
                                    href="{{ route('products.index', ['category' => 'offerte-novita']) }}">offerte e
                                    novità</a></li>
                            <li><a class="dropdown-item text-center"
                                    href="{{ route('products.index', ['category' => 'katane-accessori']) }}">katane e
                                    accessori</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- fine header -->

    <!-- section card -->
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center my-5">
                <h2>Articoli più recenti</h2>
            </div>
            @foreach ($prodotti as $prodotto)
                <div class="col-12 col-md-3 d-flex justify-content-center">
                    <x-cards :katana="$prodotto" />
                </div>
            @endforeach
    </section>
    <!-- fine section card -->

    <!-- section story -->
    <section class="container-fluid my-5 py-5">
        <div class="row align-items-center my-1">
            <div class="col-12 col-md-6">
                <p class="text-start">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt reiciendis amet asperiores ducimus
                    totam adipisci veritatis! Delectus odit numquam odio omnis deleniti maiores vel. Ipsam modi, ea
                    inventore quia non atque voluptatem animi facilis nisi esse repellendus error sunt fugiat, sit
                    blanditiis necessitatibus libero accusamus quas ab nam ex maiores consectetur quis reiciendis?
                    Dolor, mollitia aspernatur sint corrupti eius, animi sapiente eveniet nobis deleniti impedit eum,
                    quasi temporibus cupiditate. Error quas, illo quis iure et voluptatem nesciunt ratione veritatis.
                    Repellat ab neque totam natus hic quia recusandae voluptatem. Veniam vel voluptates odio nobis
                    corporis temporibus a asperiores vitae reprehenderit expedita nesciunt rerum adipisci ratione non
                    cupiditate quam, labore saepe fugiat quasi molestiae libero ea iste quisquam. Totam ut mollitia
                    nobis voluptas, aspernatur laborum explicabo voluptate, libero ipsum, odio recusandae atque quia!
                    Illo sunt nisi dignissimos nobis incidunt soluta similique. Quaerat dicta itaque blanditiis ab
                    culpa! Dignissimos maiores soluta error provident!
                </p>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{ asset('caroimg/caro3.jpg') }}" class="img-fluid" alt="">
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
                                href="{{ route('products.index', ['category' => 'katane-accessori']) }}"
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
                                href="{{ route('products.index', ['category' => 'offerte-novita']) }}"
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
                                href="{{ route('products.index', ['category' => 'arti-marziali']) }}"
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
                <img src="{{ asset('caroimg/caro4.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-12 col-md-6">
                <p class="text-end">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt reiciendis amet asperiores ducimus
                    totam adipisci veritatis! Delectus odit numquam odio omnis deleniti maiores vel. Ipsam modi, ea
                    inventore quia non atque voluptatem animi facilis nisi esse repellendus error sunt fugiat, sit
                    blanditiis necessitatibus libero accusamus quas ab nam ex maiores consectetur quis reiciendis?
                    Dolor, mollitia aspernatur sint corrupti eius, animi sapiente eveniet nobis deleniti impedit eum,
                    quasi temporibus cupiditate. Error quas, illo quis iure et voluptatem nesciunt ratione veritatis.
                    Repellat ab neque totam natus hic quia recusandae voluptatem. Veniam vel voluptates odio nobis
                    corporis temporibus a asperiores vitae reprehenderit expedita nesciunt rerum adipisci ratione non
                    cupiditate quam, labore saepe fugiat quasi molestiae libero ea iste quisquam. Totam ut mollitia
                    nobis voluptas, aspernatur laborum explicabo voluptate, libero ipsum, odio recusandae atque quia!
                    Illo sunt nisi dignissimos nobis incidunt soluta similique. Quaerat dicta itaque blanditiis ab
                    culpa! Dignissimos maiores soluta error provident!
                </p>
            </div>
        </div>
    </section>
    <!-- fine section story -->

</x-layout>
