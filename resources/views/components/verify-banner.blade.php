@auth
    @unless(Auth::user()->hasVerifiedEmail())
        <div class="alert alert-warning d-flex justify-content-between align-items-center mb-0 rounded-0 text-center">
            <span class="mx-auto">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                Il tuo indirizzo email non è ancora verificato.
            </span>
            <form method="POST" action="{{ route('verification.send') }}" class="mx-auto mt-2">
                @csrf
                <button type="submit" class="btn btn-sm btn-dark">Rinvia email di verifica</button>
            </form>
        </div>
    @endunless
@endauth