<x-layout>
    <h2 class="text-center mt-5 pt-5">Personalizza la tua katana</h2>
    <div class="container my-5">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ route('personalizzakatana_done') }}" method="POST" class="shadow p-4 rounded" novalidate>
            @csrf
            <h2 class="text-center mb-5">Configuratore Katana Personalizzata</h2>
            <div class="section-box mb-5 p-3 border rounded">
                <h4 class="mb-4 border-bottom pb-2 text-danger">1. Geometria e Misure Lama</h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Lunghezza Lama (Nagasa cm)</label>
                        <input type="number" name="nagasa_lenght" class="form-control" placeholder="es. 72"
                            min="30" max="200"  value="{{ old('nagasa_lenght') }}" required>
                        @error('nagasa_lenght')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Sori (Curvatura)</label>
                        <select name="sori" class="form-select">
                            <option value="20">20 mm</option>
                            <option value="22">22 mm</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Motohaba (Larghezza base)</label>
                        <select name="motohaba" class="form-select">
                            <option value="28">28 mm</option>
                            <option value="30">30 mm</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- FINE IMPOSTAZIONI LAMA --}}


            <div class="mb-5">
                <h4 class="mb-4 border-bottom pb-2 text-danger">2. Struttura Acciaio (Kitae)</h4>
                <div class="row row-cols-2 row-cols-md-4 g-3">
                    @foreach ($options['acciaio'] as $item)
                        <div class="col">
                            <input type="radio" name="kitae" value="{{ $item['id'] }}"
                                id="acciaio_{{ $item['id'] }}" class="btn-check" {{ old('kitae') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="acciaio_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="Maru">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- FINE IMPOSTAZIONE ACCIAIO --}}

            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">3. Presenza Bo-hi (Sguscio)</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['bohi'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="bohi" value="{{ $item['id'] }}"
                                id="bohi_{{ $item['id'] }}" class="btn-check" {{ old('bohi') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="bohi_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('kitae')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>
                @enderror
            </div>
            {{-- FINE IMPOSTAZIONE BOHI --}}

            {{-- INIZIO IMPOSTAZIONE TSUBA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">4. TSUBA</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['tsuba'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="tsuba" value="{{ $item['id'] }}"
                                id="tsuba_{{ $item['id'] }}" class="btn-check" {{ old('tsuba') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="tsuba_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('tsuba')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>
                @enderror
            </div>
            {{-- FINE IMPOSTAZIONE TSUBA --}}

            {{-- INIZIO IMPOSTAZIONE FUCHI & KASHIRA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">5. Fuchi & Kashira</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['Fuchi_Kashira'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="fuchikashira" value="{{ $item['id'] }}"
                                id="fuchikashira_{{ $item['id'] }}" class="btn-check" {{ old('fuchikashira') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="fuchikashira_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('fuchikashira')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>
                @enderror
            </div>
            {{-- FINE IMPOSTAZIONE FUCHI & KASHIRA --}}

            {{-- INIZIO IMPOSTAZIONE MENUKI --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">6. Menuki</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['menuki'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="menuki" value="{{ $item['id'] }}"
                                id="menuki_{{ $item['id'] }}" class="btn-check" {{ old('menuki') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="menuki_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('menuki')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>
                @enderror
            </div>
            {{-- FINE IMPOSTAZIONE MENUKI --}}

            {{-- INIZIO IMPOSTAZIONE HABAKI --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">7. Habaki</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['habaki'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="habaki" value="{{ $item['id'] }}"
                                id="habaki_{{ $item['id'] }}" class="btn-check" {{ old('habaki') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="habaki_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                    @error('habaki')
                        <div class="text-danger small text-center mt-2">{{ $message }}</div>
                    @enderror
            </div>
            {{-- FINE IMPOSTAZIONE HABAKI --}}

            {{-- INIZIO IMPOSTAZIONE SEPPA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">8. Seppa</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['Seppa'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="seppa" value="{{ $item['id'] }}"
                                id="seppa_{{ $item['id'] }}" class="btn-check" {{ old('seppa') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="seppa_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('seppa')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>                
                @enderror
            </div>
            {{-- FINE IMPOSTAZIONE SEPPA --}}

            {{-- INIZIO IMPOSTAZIONE SAMEGAWA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">9. Samegawa</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['Samegawa'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="samegawa" value="{{ $item['id'] }}"
                                id="samegawa_{{ $item['id'] }}" class="btn-check" {{ old('samegawa') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="samegawa_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('samegawa')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>
                @enderror
            </div>
            {{-- FINE IMPOSTAZIONE SAMEGAWA --}}

            {{-- STILE TSUKA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">10. Stile Tsuka</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['Stile_Tsuka'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="stile_tsuka" value="{{ $item['id'] }}"
                                id="stile_tsuka_{{ $item['id'] }}" class="btn-check" {{ old('stile_tsuka') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="stile_tsuka_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('stile_tsuka')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>
                @enderror
            </div>
            {{-- FINE STILE TSUKA --}}

            {{-- INIZIO COLORE TSUKA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">11. Colore Tsuka</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['Colore_Tsuka'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="colore_tsuka" value="{{ $item['id'] }}"
                                id="colore_tsuka_{{ $item['id'] }}" class="btn-check" {{ old('colore_tsuka') == $item['id'] ? 'checked' : '' }} required>
                            
                            <label class="card h-100 customcard" for="colore_tsuka_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('colore_tsuka')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>
                @enderror   
            </div>
            {{-- FINE COLORE TSUKA --}}

            {{-- INIZIO TIPO SAYA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">12. Tipo Saya</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['Tipo_Saya'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="tipo_saya" value="{{ $item['id'] }}"
                                id="tipo_saya_{{ $item['id'] }}" class="btn-check" {{ old('tipo_saya') == $item['id'] ? 'checked' : '' }} required>
                            <label class="card h-100 customcard" for="tipo_saya_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('tipo_saya')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>
                @enderror
            </div>
            {{-- FINE TIPO SAYA --}}

            {{-- COLORE SAGEO --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">13. Colore Sageo</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    @foreach ($options['Colore_Sageo'] as $item)
                        <div class="col-md-3">
                            <input type="radio" name="colore_sageo" value="{{ $item['id'] }}"
                                id="colore_sageo_{{ $item['id'] }}" class="btn-check" {{ old('colore_sageo') == $item['id'] ? 'checked' : '' }} required>
                            
                            <label class="card h-100 customcard" for="colore_sageo_{{ $item['id'] }}">
                                <img src="{{ asset('personalizza/' . $item['img']) }}" class="card-img-top"
                                    alt="{{ $item['name'] }}">
                                <div class="card-body p-2 text-center small">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('colore_sageo')
                    <div class="text-danger small text-center mt-2">{{ $message }}</div>
                @enderror
            </div>
            {{-- FINE COLORE SAGEO --}}

            <div class="section-box mb-5 p-3 border rounded">
                <h4 class="mb-4 border-bottom pb-2 text-danger">14. Impugnatura (Lunghezza Tsuka)</h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Lunghezza Tsuka (cm)</label>
                        <input type="number" name="tsuka_lenght" class="form-control" placeholder="es. 26"
                            value="{{ old('tsuka_length') }}" required>
                        @error('tsuka_length')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Non hai un'account? inserisci il tuo indirizzo email</label>
                        <input type="email" name="email" class="form-control" placeholder="es. tuo@email.com"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Dai un nome alla tua Katana</label>
                        <input type="text" name="katana_name" class="form-control"
                            placeholder="es. My Custom Katana" value="{{ old('katana_name') }}" required>
                        @error('katana_name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mt-5">
                <button type="submit" class="btn btn-danger btn-lg text-uppercase fw-bold">Invia il Progetto al
                    Maestro Forgiatore</button>
            </div>
        </form>
    </div>
</x-layout>
