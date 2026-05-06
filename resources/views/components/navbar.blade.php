<!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary position-fixed top-0 w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="{{ asset('immagini/logo_logo22.png')}}" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav  ms-auto">
                    <li class="nav-item mx-2">
                        <a id="darkicon" class="nav-link active" aria-current="page" href="#"><i class="bi bi-moon-fill"></i></a>
                    </li>
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <button class="btn btn-warning" data-bs-toggle="dropdown"
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