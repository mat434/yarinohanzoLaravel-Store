<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YariNoHanzo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">


    <!-- mycss -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary position-fixed top-0 w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="{{ asset('immagini/logo_logo22.png') }}"
                    alt="Logo"></a>
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
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <button class="btn btn-warning" data-bs-toggle="dropdown" aria-expanded="false">
                                    Carrello <span id="cart-counter">0</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/accesso">Accedi/Registrati</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- fine navbar -->

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
                            <li><a class="dropdown-item text-center" href="{{ route('products.index', ['category' => 'arti-marziali']) }}">Pratica e arti marziali</a></li>
                            <li><a class="dropdown-item text-center" href="{{ route ('products.index', ['category' => 'offerte-novita']) }}">offerte e novità</a></li>
                            <li><a class="dropdown-item text-center" href="{{ route('products.index', ['category' => 'katane-accessori']) }}">katane e accessori</a></li>
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
            <div class="col-12 col-md-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('immagini/muraka.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body px-2">
                        <h5 class="card-title">Shiruya Haji</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card’s
                            content.</p>
                        <a href="/articolo" class="btn btn-success">Acquista</a>
                        <a href="" class="btn btn-warning add-to-cart ms-2"><i class="bi bi-cart"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('immagini/yagyu.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body px-2">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card’s
                            content.</p>
                        <a href="#" class="btn btn-success">Acquista</a>
                        <a href="" class="btn btn-warning ms-2"><i class="bi bi-cart"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('immagini/nobunaga.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body px-2">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card’s
                            content.</p>
                        <a href="#" class="btn btn-success">Acquista</a>
                        <a href="" class="btn btn-warning ms-2"><i class="bi bi-cart"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('immagini/yagyu.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body px-2">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card’s
                            content.</p>
                        <a href="#" class="btn btn-success">Acquista</a>
                        <a href="" class="btn btn-warning ms-2"><i class="bi bi-cart"></i></a>
                    </div>
                </div>
            </div>
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
                        <p class="card-text text-start"><a href="{{ route('products.index', ['category' => 'katane-accessori']) }}"
                                class="stretched-link">Scopri di più</a></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-dark text-white">
                    <img src="{{ asset('categorie/offerte.png') }}" class="card-img" alt="...">
                    <div class="card-img-overlay h-100">
                        <h5 class="card-title text-center category2">Novità e offerte</h5>
                        <p class="card-text text-center"><a href="{{ route('products.index', ['category' => 'offerte-novita']) }}" class="stretched-link">Scopri di più</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-dark text-white">
                    <img src="{{ asset('categorie/pratica e arti marziali.png') }}" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title text-end category3">pratica, arti marziali</h5>
                        <p class="card-text text-end"><a href="{{ route('products.index', ['category' => 'arti-marziali']) }}"
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

    <!-- footer -->
    <footer class="container-fluid">
        <div class="row footercustom bg-dark text-white justify-content-around align-items-center pt-4">
            <div class="col-12 col-md-3">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis iure similique ullam sapiente.
                    Numquam ducimus ex incidunt veniam esse praesentium.</p>
            </div>
            <div class="col-12 col-md-3">
                <ul>
                    <li><a href="">Contattaci</a></li>
                    <li><a href="">Spedizioni</a></li>
                    <li><a href="">Termini e condizioni</a></li>
                    <li><a href="https://www.instagram.com/yarinohanzoswords/" target="_blank">Instangram</a> <i
                            class="bi bi-instagram ms-1"></i></li>
                    <li><a href="https://www.facebook.com/YariNoHanzoKatana/?locale=it_IT"
                            target="_blank">Facebook</a>
                        <i class="bi bi-facebook ms-1"></i>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- fine footer -->





    <!-- bootastrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <!-- my js -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
