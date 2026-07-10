<x-layout>
    <div class="container-fluid custom-auth-bg py-5">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-12 col-md-5 d-flex justify-content-center align-items-center mb-4 mb-md-0 px-lg-5">
                <div class="auth-img-wrapper w-100">
                    <img src="{{ asset('immagini/fukushima.jpg') }}" class="img-fluid custom-auth-img" alt="Forgia Katana">
                </div>
            </div>

            <div class="d-none d-md-block custom-auth-divider"></div>

            <div class="col-12 col-md-5 p-4 p-lg-5">
                {{-- Blocco Errori Validazione --}}
                @if ($errors->any())
                    <div class="alert alert-danger custom-alert-minimal mb-4">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="small text-uppercase letter-spacing-05">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.store') }}" method="POST" class="auth-form-minimal">
                    @csrf
                    <h1 class="text-uppercase custom-auth-title mb-1">Registrati</h1>
                    <p class="text-muted small text-uppercase letter-spacing-1 mb-4">Unisciti alla forgia di YariNoHanzo</p>

                    {{-- Nome Utente --}}
                    <div class="mb-3">
                        <label for="nameuser" class="form-label custom-auth-label text-uppercase">Nome Utente</label>
                        <input type="text" name="name" class="form-control custom-auth-input" id="nameuser" required
                            value="{{ old('name') }}" placeholder="Es. Musashi Miyamoto">
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label custom-auth-label text-uppercase">Email</label>
                        <input type="email" name="email" class="form-control custom-auth-input" id="exampleInputEmail1" required
                            value="{{ old('email') }}" placeholder="esempio@dominio.com">
                    </div>

                    {{-- Password con Input Group e Toggle Occhio --}}
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label custom-auth-label text-uppercase">Password</label>
                        <div class="input-group custom-input-group-minimal">
                            <input type="password" name="password" class="form-control custom-auth-input" id="passwordInput" required placeholder="••••••••">
                            <button type="button" class="btn btn-toggle-password" id="togglePassword">
                                <i class="bi bi-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Conferma Password con Input Group e Toggle Occhio --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label custom-auth-label text-uppercase">Conferma Password</label>
                        <div class="input-group custom-input-group-minimal">
                            <input type="password" name="password_confirmation" class="form-control custom-auth-input" id="password_confirmation" required placeholder="••••••••">
                            <button type="button" class="btn btn-toggle-password" id="togglePasswordConfirmation">
                                <i class="bi bi-eye" id="eyeIconConfirmation"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-auth-minimal w-100 text-uppercase fw-bold py-3">Crea Account</button>
                </form>
            </div>

        </div>
    </div>
</x-layout>