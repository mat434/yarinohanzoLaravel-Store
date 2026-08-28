@unless(request()->routeIs('welcome'))
    <button type="button" onclick="history.back()" class="btn-back-minimal" title="Torna indietro">
        <i class="bi bi-arrow-left"></i>
    </button>
@endunless