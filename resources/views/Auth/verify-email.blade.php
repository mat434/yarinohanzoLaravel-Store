<x-layout>
    <div class="container-fluid custom-auth-bg py-5">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-12 col-md-6 p-4 p-lg-5 text-center">

                @if (session('success'))
                    <div class="alert alert-success custom-alert-minimal mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <h1 class="text-uppercase custom-auth-title mb-3">Verifica la tua Email</h1>
                <p class="text-muted mb-4">
                    Grazie per esserti registrato! Prima di continuare, controlla la tua casella di posta:
                    ti abbiamo inviato un link per verificare il tuo indirizzo email.
                </p>

                <p class="text-muted small mb-4">Non hai ricevuto l'email?</p>

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-auth-minimal w-100 text-uppercase fw-bold py-3">
                        Rinvia Email di Verifica
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-link text-muted text-uppercase small">
                        Esci
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-layout>