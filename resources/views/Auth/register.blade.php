<x-layout>


    <div class="container-fluid">
        <div class="col-12 col-md-12 mt-5 text-center py-5">
            <h1>Registrati a Yari No Hanzo</h1>
        </div>
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

            <!--Immagine -->
            <div class="col-md-5 d-flex justify-content-center align-items-center">
                <img src="{{ asset('immagini/fukushima.jpg') }}" class="img-fluid rounded shadow" alt="Forgia Katana">
            </div>

            <!-- DIVIDER -->
            <div class="d-none d-md-block" style="border-left: 2px solid #dee2e6; height: 400px; width: 0px; padding: 0;">
            </div>
            {{-- FINE DIVIDER  --}}

            <!-- Form -->
            <div class="col-md-5 p-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <h2 class="mb-4">Unisciti alla Forgia</h2>

                    <div class="mb-3">
                        <label for="nameuser" class="form-label">Nome Utente</label>
                        <input type="text" name="name" class="form-control" id="nameuser" required
                            value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" required
                            value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="passwordInput" required>

                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Conferma Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" required>

                            <button type="button" class="btn btn-outline-secondary" id="togglePasswordConfirmation">
                                <i class="bi bi-eye" id="eyeIconConfirmation"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Registrati</button>
                </form>
            </div>

        </div>
    </div>

</x-layout>
