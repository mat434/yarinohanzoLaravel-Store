<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shiruya</title>
    <!-- css boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- my css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- inizio navbar -->
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
                                <button class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Carrello
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
                        <a class="nav-link" href="/accesso">Accedi</a>
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

    <!-- inizio paragraph -->
    <section class="container-fluid my-5 py-5">
        <div class="row my-2 justify-content-start align-items-center">
            <div class="col-12 col-md-6">
                {{-- carousel --}}
                <div id="carouselExampleIndicators" class="carousel slide caroarticle">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/caroimg/caro1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/caroimg/caro2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/caroimg/caro3.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                {{-- fine carousel --}}
            </div>
            <div class="col-12 col-md-6 text-end">
                <h3>Shiruya Haji</h3>
                <p>
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
    <!-- fine paragraph -->

    <!-- section dettagli -->
    <section class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item">And a fifth one</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item">And a fifth one</li>
                </ul>
            </div>
            <div class="col-12 col-md-6 my-2 text-end">
                <ul class="ulpay">
                    <li class="my-2">Costo 125,00 euro</li>
                </ul>
                <button class="btn btn-success">Acquista</button>
            </div>
        </div>
        </div>
    </section>
    <!-- fine section dettagli -->

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







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
