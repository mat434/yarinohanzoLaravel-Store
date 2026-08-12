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

                <form action="{{ route('password.update') }}" method="POST" class="auth-form-minimal">
                    @csrf

                    {{-- Campi nascosti obbligatori: il token del link e l'email --}}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <h1 class="text-uppercase custom-auth-title mb-1">Nuova Password</h1>
                    <p class="text-muted small text-uppercase letter-spacing-1 mb-4">Scegli una nuova password sicura</p>

                    <div class="mb-3">
                        <label for="password" class="form-label custom-auth-label text-uppercase">Nuova Password</label>
                        <input type="password" name="password" class="form-control custom-auth-input" id="password" required placeholder="••••••••">
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label custom-auth-label text-uppercase">Conferma Password</label>
                        <input type="password" name="password_confirmation" class="form-control custom-auth-input" id="password_confirmation" required placeholder="••••••••">
                    </div>

                    <button type="submit" class="btn btn-auth-minimal w-100 text-uppercase fw-bold py-3">Reimposta Password</button>
                </form>
            </div>

        </div>
    </div>
</x-layout>