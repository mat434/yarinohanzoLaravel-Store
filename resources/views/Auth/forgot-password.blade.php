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
                @if (session('success'))
                    <div class="alert alert-success custom-alert-minimal mb-4">
                        {{ session('success') }}
                    </div>
                @endif

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

                <form action="{{ route('password.email') }}" method="POST" class="auth-form-minimal">
                    @csrf
                    <h1 class="text-uppercase custom-auth-title mb-1">Password Dimenticata</h1>
                    <p class="text-muted small text-uppercase letter-spacing-1 mb-4">Ti invieremo un link per reimpostarla</p>

                    <div class="mb-4">
                        <label for="email" class="form-label custom-auth-label text-uppercase">Indirizzo Email</label>
                        <input type="email" name="email" class="form-control custom-auth-input" id="email" required value="{{ old('email') }}" placeholder="esempio@dominio.com">
                    </div>

                    <button type="submit" class="btn btn-auth-minimal w-100 text-uppercase fw-bold py-3">Invia Link di Reset</button>

                    <div class="mt-3 text-center">
                        <a href="{{ route('login') }}" class="text-muted small text-uppercase letter-spacing-1 auth-secondary-link">Torna al Login</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-layout>