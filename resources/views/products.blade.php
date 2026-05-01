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


    <!-- testo principale -->
    <section class="container-fluid my-5 py-5 ">
        <div class="row justify-content-center my-5">
            <div class="col-12 col-md-12">
                <h2 class="text-center">{{ $titolo }}</h2>
                <h4 class="text-center">{{ $description }}</h4>
            </div>
        </div>
    </section>
    <!-- fine testo -->


    <!-- main card -->
    <main class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-3">
                <ul class="list-group me-5 pe-4">
                    <li class="list-group-item"><a href="">sotto categoria 1</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 2</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 3</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 4</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 5</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 6</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 7</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 8</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 9</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 10</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 11</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 12</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 13</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 14</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 15</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($offerte as $katana)
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset($katana['img']) }}" alt="{{ $katana['nome'] }}"  class="card-img-top" alt="...">
                            <div class="card-body px-2">
                                <h5 class="card-title">{{ $katana['nome'] }}</h5>
                                <p class="card-text">{{ $katana['descrizione'] }}</p>
                                <a href="/articolo" class="btn btn-success">Acquista</a>
                                <a href="{{ route('article', ['id' => $katana['id']]) }}" class="btn btn-warning ms-2"><i class="bi bi-cart"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <!-- fine main card -->



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
