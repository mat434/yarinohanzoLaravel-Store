<x-layout>
    <h2 class="text-center mt-5 pt-5">Personalizza la tua katana</h2>
    <div class="container my-5">
        <form action="" method="POST" class="shadow p-4 bg-white rounded">
            @csrf
            <h2 class="text-center mb-5">Configuratore Katana Personalizzata</h2>
            <div class="section-box mb-5 p-3 border rounded bg-light">
                <h4 class="mb-4 border-bottom pb-2 text-danger">1. Geometria e Misure Lama</h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Lunghezza Lama (Nagasa cm)</label>
                        <input type="number" name="nagasa_length" class="form-control" placeholder="es. 72"
                            min="60" max="90" required>
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
                    <div class="col">
                        <input type="radio" name="kitae" value="maru" id="maru" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="maru">
                            <img src="{{ asset('personalizza/acciao10601.jpg') }}" class="card-img-top" alt="Maru">
                            <div class="card-body p-2 text-center small">MarukKitae 1060</div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <div class="row row-cols-2 row-cols-md-4 g-3">
                    <div class="col">
                        <input type="radio" name="kitae" value="maru" id="maru" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="maru">
                            <img src="{{ asset('personalizza/acciaio1060-45-95-2.jpg') }}" class="card-img-top" alt="Maru">
                            <div class="card-body p-2 text-center small">MaruKitae 1060 + 1045 + 1090</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE IMPOSTAZIONE ACCIAIO --}}

            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">3. Presenza Bo-hi (Sguscio)</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE IMPOSTAZIONE BOHI --}}

            {{-- INIZIO IMPOSTAZIONE TSUBA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">4. TSUBA</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/tsubakocho1.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Tsuba Kocho</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/TsubaFuku2.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Tsuba Fuku</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/tsubaMusha3.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Tsuba Musha</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE IMPOSTAZIONE TSUBA --}}

            {{-- INIZIO IMPOSTAZIONE FUCHI & KASHIRA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">5. Fuchi & Kashira</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE IMPOSTAZIONE FUCHI & KASHIRA --}}

            {{-- INIZIO IMPOSTAZIONE MENUKI --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">6. Menuki</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE IMPOSTAZIONE MENUKI --}}

            {{-- INIZIO IMPOSTAZIONE HABAKI --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">7. Habaki</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE IMPOSTAZIONE HABAKI --}}

            {{-- INIZIO IMPOSTAZIONE SEPPA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">8. Seppa</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE IMPOSTAZIONE SEPPA --}}

            {{-- INIZIO IMPOSTAZIONE SAMEGAWA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">9. Samegawa</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE IMPOSTAZIONE SAMEGAWA --}}

            {{-- STILE TSUKA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">10. Stile Tsuka</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE STILE STUKA --}}

            {{-- INIZIO COLORE TSUKA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">11. Colore Tsuka</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE COLORE TSUKA --}}

            {{-- INIZIO TIPO SAYA --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">12. Tipo Saya</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE TIPO SAYA --}}

            {{-- COLORE SAGEO --}}
            <div class="mb-5 text-center">
                <h4 class="mb-4 border-bottom pb-2 text-danger">13. Colore Sageo</h4>
                <div class="row row-cols-2 justify-content-center g-3">
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="yes" id="bohi_yes" class="btn-check" required>
                        <label class="card h-100 custom-card-selectable" for="bohi_yes">
                            <img src="{{ asset('personalizza/bohi.jpg') }}" class="card-img-top" alt="Con Bo-hi">
                            <div class="card-body p-2 text-center small">Con Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/NObohi.jpg') }}" class="card-img-top" alt="Senza Bo-hi">
                            <div class="card-body p-2 text-center small">Senza Bo-hi</div>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="bohi" value="no" id="bohi_no" class="btn-check">
                        <label class="card h-100 custom-card-selectable" for="bohi_no">
                            <img src="{{ asset('personalizza/doppiohi.jpg') }}" class="card-img-top" alt="Doppio Bo-hi">
                            <div class="card-body p-2 text-center small">Doppio Bo-hi</div>
                        </label>
                    </div>
                </div>
            </div>
            {{-- FINE COLORE SAGEO --}}

            <div class="section-box mb-5 p-3 border rounded bg-light">
                <h4 class="mb-4 border-bottom pb-2 text-danger">14. Impugnatura (Lunghezza Tsuka)</h4>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Lunghezza Tsuka (cm)</label>
                        <input type="number" name="tsuka_length" class="form-control" placeholder="es. 26">
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
