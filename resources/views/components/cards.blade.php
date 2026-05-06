<div class="card" style="width: 18rem;">
    <img src="{{ asset($katana['img']) }}" alt="{{ $katana['nome'] }}" class="card-img-top" alt="...">
    <div class="card-body px-2">
        <h5 class="card-title">{{ $katana['nome'] }}</h5>
        <p class="card-text">{{ $katana['descrizione'] }}</p>
        <a href="/articolo" class="btn btn-success">Acquista</a>
        <a href="{{ route('article', ['id' => $katana['id']]) }}" class="btn btn-warning ms-2"><i
                class="bi bi-cart"></i></a>
    </div>
</div>
