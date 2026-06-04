@props(['type', 'subcategories', 'slug' => null])

<div class="col-12 col-md-3">
    <form action="" method="GET" id="sidebar-filter-form">
        
        {{-- 1. SEZIONE SOTTOCATEGORIE KATANA --}}
        @if($type === 'katana')
            <h5 class="mb-3 fw-bold">Sottocategorie Katane</h5>
            <div class="mb-4 pe-2">
                {{-- Reindirizza direttamente all'URI pulito (es. /katana/superior) --}}
                <select class="form-select form-select-sm mt-3" onchange="window.location.href = this.value ? '/{{ $type }}/' + this.value : '/{{ $type }}';">
                    <option value="">Tutte le Katane e Iaito</option>
                    @foreach($subcategories->whereIn('slug', ['basics', 'practical', 'performance', 'superior', 'damasco', 'daisho-set-katana', 'tanto', 'wakizashi', 'alternative-special']) as $sub)
                        <option value="{{ $sub->slug }}" {{ $slug == $sub->slug ? 'selected' : '' }}>
                            {{ $sub->nome }}
                        </option>
                    @endforeach
                </select>

                <select class="form-select form-select-sm mt-3" onchange="window.location.href = this.value ? '/{{ $type }}/' + this.value : '/{{ $type }}';">
                    <option value="">Manutenzione e accessori</option>
                    @foreach($subcategories->whereIn('slug', ['kit-manutenzione', 'sageo', 'saya-e-tsuba', 'mini-katane-e-penne', 'sacche-e-borse', 'katana-kake-supporti']) as $sub)
                        <option value="{{ $sub->slug }}" {{ $slug == $sub->slug ? 'selected' : '' }}>
                            {{ $sub->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        {{-- 2. SEZIONE SOTTOCATEGORIE ARTI MARZIALI --}}
        @if($type === 'martial')
            <h5 class="mb-3 fw-bold">Sottocategorie Arti Marziali</h5>
            <div class="mb-4 pe-2">
                <select class="form-select form-select-sm mt-3" onchange="window.location.href = this.value ? '/prodotti/{{ $type }}/' + this.value : '/prodotti/{{ $type }}';">
                    <option value="">Tutto l'Abbigliamento</option>
                    @foreach($subcategories->whereIn('slug', ['iaido-gi', 'kendo-gi', 'hakama', 'ninjutsu-gi', 'aikido-gi', 'judo-gi', 'karate-gi']) as $sub)
                        <option value="{{ $sub->slug }}" {{ $slug == $sub->slug ? 'selected' : '' }}>
                            {{ $sub->nome }}
                        </option>
                    @endforeach
                </select>

                <select class="form-select form-select-sm mt-3" onchange="window.location.href = this.value ? '/prodotti/{{ $type }}/' + this.value : '/prodotti/{{ $type }}';">
                    <option value="">Bokken e Armi in legno</option>
                    @foreach($subcategories->whereIn('slug', ['ryuha', 'standard', 'budoguningu', 'bo-jo-hanbo', 'yari-naginata', 'wenge', 'lignum-vitae']) as $sub)
                        <option value="{{ $sub->slug }}" {{ $slug == $sub->slug ? 'selected' : '' }}>
                            {{ $sub->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        {{-- 3. SEZIONE FILTRA OFFERTE --}}
        @if($type === 'offer')
            <h5 class="mb-3 fw-bold">Filtra Offerte</h5>
            <div class="mb-4 pe-2">
                {{-- Nota: Presumo che la rotta base delle offerte sia /offerte, modificalo se usi /offer --}}
                <select class="form-select form-select-sm mt-3" onchange="window.location.href = this.value ? '/prodotti/offerte/' + this.value : '/prodotti/offerte';">
                    <option value="">Seleziona Reparto</option>
                    @foreach($subcategories as $sub)
                        <option value="{{ $sub->slug }}" {{ $slug == $sub->slug ? 'selected' : '' }}>
                            {{ $sub->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        
        {{-- 4. FASCIA DI PREZZO (COMUNE A KATANA E ARTI MARZIALI) --}}
        @if($type === 'katana' || $type === 'martial')
            <hr>
            <h5 class="mb-3 fw-bold">Fascia di Prezzo</h5>
            <div class="mb-4 pe-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_range" value="100" id="price1" {{ request('price_range') == '100' ? 'checked' : '' }}>
                    <label class="form-check-label" for="price1">Fino a 100€</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_range" value="100-300" id="price2" {{ request('price_range') == '100-300' ? 'checked' : '' }}>
                    <label class="form-check-label" for="price2">100€ - 300€</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_range" value="300" id="price3" {{ request('price_range') == '300' ? 'checked' : '' }}>
                    <label class="form-check-label" for="price3">Oltre 300€</label>
                </div>
                
                <select name="order_by" class="form-select form-select-sm mt-3" onchange="this.form.submit();">
                    <option value="">Ordina per prezzo...</option>
                    <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>Dal più basso al più alto</option>
                    <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>Dal più alto al più basso</option>
                </select>
            </div>
        @endif

        {{-- 5. FILTRO ACCIAIO (SOLO KATANA) --}}
        @if($type === 'katana')
            <hr>
            <h5 class="mb-3 fw-bold">Tipo di Acciaio</h5>
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="steel[]" value="1045" id="steel1045" {{ is_array(request('steel')) && in_array('1045', request('steel')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="steel1045">Acciaio al carbonio 1045</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="steel[]" value="1060" id="steel1060" {{ is_array(request('steel')) && in_array('1060', request('steel')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="steel1060">Acciaio al carbonio 1060</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="steel[]" value="1095" id="steel1095" {{ is_array(request('steel')) && in_array('1095', request('steel')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="steel1095">Acciaio ripiegato 1095</label>
                </div>
            </div>
        @endif

        {{-- 6. FILTRO MATERIALE (SOLO ARTI MARZIALI) --}}
        @if($type === 'martial')
            <hr>
            <h5 class="mb-3 fw-bold">Materiale</h5>
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="material[]" value="cotone" id="matCotone" {{ is_array(request('material')) && in_array('cotone', request('material')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="matCotone">100% Cotone</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="material[]" value="legno" id="matLegno" {{ is_array(request('material')) && in_array('legno', request('material')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="matLegno">Legno di Quercia (Bokken)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="material[]" value="poliestere" id="matPol" {{ is_array(request('material')) && in_array('poliestere', request('material')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="matPol">Poliestere / Sintetico</label>
                </div>
            </div>
        @endif

        <button type="submit" class="btn btn-warning btn-sm w-100 mt-2 fw-bold">Applica Filtri</button>
        <a href="{{ url()->current() }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">Reset</a>
    </form>
</div>