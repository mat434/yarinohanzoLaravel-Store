<x-layout>
    <div class="container my-5 py-5">
        <h2 class="fw-bold mb-4" style="font-family: 'Oswald', sans-serif;">Richieste di Reso — Pannello Admin</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @forelse($returnRequests as $returnRequest)
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <strong>Reso #{{ $returnRequest->id }}</strong>
                            <span class="text-muted"> — Ordine #{{ $returnRequest->order->id }}</span>
                            <br>
                            <small class="text-muted">
                                Richiesto da {{ $returnRequest->user->name ?? $returnRequest->order->email }}
                                il {{ $returnRequest->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>

                        @php
                            $badgeColor = match($returnRequest->status) {
                                'richiesto' => 'bg-warning text-dark',
                                'in_lavorazione' => 'bg-info text-dark',
                                'completato' => 'bg-success',
                                'rifiutato' => 'bg-danger',
                                default => 'bg-secondary',
                            };
                        @endphp
                        <span class="badge {{ $badgeColor }}">{{ ucfirst(str_replace('_', ' ', $returnRequest->status)) }}</span>
                    </div>

                    <p class="mb-1">
                        <strong>Metodo:</strong>
                        {{ $returnRequest->return_method === 'domicilio' ? 'Ritiro a domicilio' : 'Punto postale' }}
                    </p>

                    @if($returnRequest->motivo)
                        <p class="mb-2"><strong>Motivo:</strong> {{ $returnRequest->motivo }}</p>
                    @endif

                    <ul class="list-group list-group-flush mb-3">
                        @foreach($returnRequest->items as $returnItem)
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span>{{ $returnItem->orderItem->nome }}</span>
                                <span class="text-muted">Quantità: {{ $returnItem->quantity }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <form method="POST" action="{{ route('admin.returns.updateStatus', $returnRequest) }}" class="d-flex gap-2 align-items-center">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select form-select-sm" style="width:auto;">
                            <option value="richiesto" @selected($returnRequest->status === 'richiesto')>Richiesto</option>
                            <option value="in_lavorazione" @selected($returnRequest->status === 'in_lavorazione')>In lavorazione</option>
                            <option value="completato" @selected($returnRequest->status === 'completato')>Completato</option>
                            <option value="rifiutato" @selected($returnRequest->status === 'rifiutato')>Rifiutato</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-dark">Aggiorna Stato</button>
                    </form>

                </div>
            </div>
        @empty
            <p class="text-muted">Nessuna richiesta di reso al momento.</p>
        @endforelse

    </div>
</x-layout>