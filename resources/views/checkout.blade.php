<x-layout>
    <div class="container mb-5" style="margin-top: 120px;">
        <div class="row g-5">
            {{-- COLONNA SINISTRA: Form Dati e Pagamento --}}
            <div class="col-12 col-lg-7">
                <h4 class="mb-4 fw-bold text-uppercase border-bottom pb-2">Dati di Spedizione e Pagamento</h4>

                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Nome Completo</label>
                            <input type="text" name="nome" class="form-control" value="{{ Auth::user()->name ?? '' }}" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email ?? '' }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Indirizzo di Consegna</label>
                            <input type="text" name="indirizzo" class="form-control" placeholder="Via/Piazza, Numero Civico" required>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label fw-semibold">Città</label>
                            <input type="text" name="citta" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">CAP</label>
                            <input type="text" name="cap" class="form-control" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Opzioni di spedizione --}}
                    <h5 class="mb-3 fw-bold">Metodo di Spedizione</h5>
                    <div class="mb-3">
                        <div class="form-check border rounded p-3 mb-2">
                            <input class="form-check-input shipping-option" type="radio" name="shipping_type"
                                id="shippingStandard" value="standard" checked data-cost="0">
                            <label class="form-check-label w-100 d-flex justify-content-between" for="shippingStandard">
                                <span><i class="bi bi-truck me-2"></i>Standard (3-5 giorni lavorativi)</span>
                                <span class="fw-bold text-success">Gratuita</span>
                            </label>
                        </div>

                        <div class="form-check border rounded p-3">
                            <input class="form-check-input shipping-option" type="radio" name="shipping_type"
                                id="shippingExpress" value="express" data-cost="{{ $expressCost }}">
                            <label class="form-check-label w-100 d-flex justify-content-between" for="shippingExpress">
                                <span><i class="bi bi-lightning-charge-fill me-2"></i>Express (1-2 giorni lavorativi)</span>
                                <span class="fw-bold {{ $expressCost > 0 ? 'text-dark' : 'text-success' }}">
                                    {{ $expressCost > 0 ? number_format($expressCost, 2, ',', '.') . '€' : 'Gratuita' }}
                                </span>
                            </label>
                        </div>

                        @if($expressCost == 0)
                            <p class="text-muted small mt-2 mb-0">
                                <i class="bi bi-info-circle me-1"></i>Spedizione Express gratuita per ordini superiori a 50€.
                            </p>
                        @endif
                    </div>

                    <hr class="my-4">

                    <p class="text-muted small">Sarai reindirizzato a una pagina di pagamento sicura per completare l'acquisto.</p>

                    <button id="submitBtn" class="w-100 btn btn-success btn-lg fw-bold mt-4 shadow" type="submit">
                        Procedi al Pagamento (<span id="btnTotal">{{ number_format($totalPrice, 2, ',', '.') }}</span>€)
                    </button>
                </form>
            </div>

            {{-- COLONNA DESTRA: Riepilogo Ordine --}}
            <div class="col-12 col-lg-5">
                <div class="card shadow-sm border-0 bg-light p-4 position-sticky" style="top: 120px;">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted fw-bold">Riepilogo Ordine</span>
                        <span class="badge bg-secondary rounded-pill">
                            {{ array_sum(array_column($cart, 'quantity')) + ($customKatana ? 1 : 0) }}
                        </span>
                    </h4>

                    <ul class="list-group mb-3 border-0">
                        {{-- Oggetti Standard del Carrello --}}
                        @foreach($cart as $itemCart)
                            <li class="list-group-item d-flex justify-content-between lh-sm bg-transparent border-0 border-bottom px-0 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($itemCart['img']) }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded me-3 shadow-sm">
                                    <div>
                                        <h6 class="my-0 fw-bold text-truncate" style="max-width: 200px;">{{ $itemCart['nome'] }}</h6>
                                        <small class="text-muted">Qta: {{ $itemCart['quantity'] }}</small>
                                    </div>
                                </div>
                                <span class="text-muted fw-semibold">{{ number_format($itemCart['prezzo'] * $itemCart['quantity'], 2, ',', '.') }}€</span>
                            </li>
                        @endforeach

                        {{-- Blocco dedicato alla Katana Personalizzata --}}
                        @if($customKatana)
                            <li class="list-group-item d-flex justify-content-between lh-sm bg-transparent border-0 border-bottom px-0 py-3">
                                <div class="d-flex align-items-start">
                                    <div class="bg-dark text-warning rounded me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; min-width: 50px;">
                                        <i class="bi bi-tools fs-4"></i>
                                    </div>
                                    <div>
                                        <h6 class="my-0 fw-bold text-success">{{ $customKatana['info']['katana_name'] }}</h6>
                                        <small class="text-muted d-block mt-1">Lama (Nagasa): <strong>{{ $customKatana['info']['nagasa_lenght'] }} cm</strong></small>
                                        <small class="text-muted d-block">Impugnatura (Tsuka): <strong>{{ $customKatana['info']['tsuka_lenght'] }} cm</strong></small>

                                        <div class="mt-2 pt-2 border-top border-secondary border-opacity-10" style="font-size: 0.8rem; line-height: 1.3;">
                                            @foreach($customKatana['dettagli_visibili'] as $componente => $scelta)
                                                <div class="text-muted mb-1">
                                                    <span class="text-secondary">{{ $componente }}:</span>
                                                    <span class="fw-semibold text-dark">{{ $scelta }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <span class="text-muted fw-semibold">{{ number_format($customKatana['prezzo'], 2, ',', '.') }}€</span>
                            </li>
                        @endif

                        {{-- Riga Spedizione, aggiornata dal JS in base alla scelta --}}
                        <li class="list-group-item d-flex justify-content-between bg-transparent border-0 px-0 py-2">
                            <span class="text-muted">Spedizione</span>
                            <span id="shippingLabel" class="fw-semibold text-success">Gratuita</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between bg-transparent border-0 px-0 pt-3">
                            <span class="fs-5 fw-bold">Totale complessivo:</span>
                            <strong class="fs-5 text-danger" id="summaryTotal">{{ number_format($totalPrice, 2, ',', '.') }}€</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subtotal = {{ $subtotal }};
            const shippingOptions = document.querySelectorAll('.shipping-option');
            const shippingLabel = document.getElementById('shippingLabel');
            const summaryTotal = document.getElementById('summaryTotal');
            const btnTotal = document.getElementById('btnTotal');

            function formatEuro(value) {
                return value.toLocaleString('it-IT', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }

            function updateTotals() {
                const selected = document.querySelector('.shipping-option:checked');
                const cost = parseFloat(selected.dataset.cost);
                const total = subtotal + cost;

                shippingLabel.textContent = cost > 0 ? formatEuro(cost) + '€' : 'Gratuita';
                shippingLabel.className = cost > 0 ? 'fw-semibold text-dark' : 'fw-semibold text-success';

                summaryTotal.textContent = formatEuro(total) + '€';
                btnTotal.textContent = formatEuro(total);
            }

            shippingOptions.forEach(option => {
                option.addEventListener('change', updateTotals);
            });

            updateTotals();
        });
    </script>
</x-layout>