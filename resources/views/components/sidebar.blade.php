@props(['type', 'subcategories'])

<div class="col-12 col-md-3">
    {{-- katana --}}
    @if($type === 'katana')
        <h5 class="mb-3 fw-bold">Sottocategorie Katane</h5>
        <div class="mb-4 pe-2">
            <select class="form-select form-select-sm mt-3" onchange="location = this.value;">
                <option selected disabled>Katana e Iaito</option>
                @foreach($subcategories as $sub)
                    <option value="{{ $sub['link'] }}">{{ $sub['nome'] }}</option>
                @endforeach
            </select>

            <select class="form-select form-select-sm mt-3" onchange="location = this.value;">
                <option selected disabled>Manutenzione e accessori</option>
                <option value="#">Kit manutenzione</option>
                <option value="#">Sageo</option>
                <option value="#">Saya e tsuba</option>
                <option value="#">Mini katane e penne</option>
                <option value="#">Sacche e borse</option>
                <option value="#">Katana Kake (Supporti)</option>
            </select>
        </div>
    @endif
    {{-- fine katana --}}

    {{-- martial art --}}
    @if($type === 'martial')
        <h5 class="mb-3 fw-bold">Sottocategorie Arti Marziali</h5>
        <div class="mb-4 pe-2">
            <select class="form-select form-select-sm mt-3" onchange="location = this.value;">
                <option selected disabled>Abbigliamento</option>
                @foreach($subcategories as $sub)
                    <option value="{{ $sub['link'] }}">{{ $sub['nome'] }}</option>
                @endforeach
            </select>

            <select class="form-select form-select-sm mt-3" onchange="location = this.value;">
                <option selected disabled>Accessori</option>
                <option value="#">Set di uniformi</option>
                <option value="#">Obi/Cinture</option>
                <option value="#">Tabi, Tekou, Kyahan</option>
                <option value="#">Zaini</option>
            </select>

            <select class="form-select form-select-sm mt-3" onchange="location = this.value;">
                <option selected disabled>Bokken e Armi in legno</option>
                <option value="#">Ryuha</option>
                <option value="#">Standard</option>
                <option value="#">Budogu&Ningu</option>
                <option value="#">Bo Jo/Hanbo</option>
                <option value="#">Yari/Naginata</option>
                <option value="#">Wengè</option>
                <option value="#">Lignum Vitae</option>
            </select>
        </div>
    @endif
    {{-- fine martial art --}}

    {{-- offer --}}
    @if($type === 'offer')
        <h5 class="mb-3 fw-bold">Filtra Offerte</h5>
        <div class="mb-4 pe-2">
            <select class="form-select form-select-sm mt-3" onchange="location = this.value;">
                <option selected disabled>Seleziona Reparto</option>
                @foreach($subcategories as $sub)
                <option href="{{ $sub['link'] }}" value="asc" class="text-decoration-none text-dark">{{ $sub['nome'] }} </option>
                @endforeach
            </select>
        </div>
    @endif
    {{-- fine offer --}}
    
    @if($type === 'katana' || $type === 'martial')
        <hr>
        <h5 class="mb-3 fw-bold">Fascia di Prezzo</h5>
        <div class="mb-4 pe-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="price_filter" id="price1">
                <label class="form-check-input-label" for="price1">Fino a 100€</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="price_filter" id="price2">
                <label class="form-check-input-label" for="price2">100€ - 300€</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="price_filter" id="price3">
                <label class="form-check-input-label" for="price3">Oltre 300€</label>
            </div>
            
            <select class="form-select form-select-sm mt-3">
                <option selected>Ordina per prezzo...</option>
                <option value="asc">Dal più basso al più alto</option>
                <option value="desc">Dal più alto al più basso</option>
            </select>
        </div>
    @endif

    @if($type === 'katana')
        <hr>
        <h5 class="mb-3 fw-bold">Tipo di Acciaio</h5>
        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1045" id="steel1045">
                <label class="form-check-label" for="steel1045">Acciaio al carbonio 1045</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1060" id="steel1060">
                <label class="form-check-label" for="steel1060">Acciaio al carbonio 1060</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1095" id="steel1095">
                <label class="form-check-label" for="steel1095">Acciaio ripiegato 1095</label>
            </div>
        </div>
    @endif

    @if($type === 'martial')
        <hr>
        <h5 class="mb-3 fw-bold">Materiale</h5>
        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="cotone" id="matCotone">
                <label class="form-check-label" for="matCotone">100% Cotone</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="legno" id="matLegno">
                <label class="form-check-label" for="matLegno">Legno di Quercia (Bokken)</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="poliestere" id="matPol">
                <label class="form-check-label" for="matPol">Poliestere / Sintetico</label>
            </div>
        </div>
    @endif
</div>