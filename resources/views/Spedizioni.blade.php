<x-layout>
    <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <h2 class="fw-bold mb-4" style="font-family: 'Oswald', sans-serif;">Spedizioni</h2>

                <p class="text-muted mb-4">
                    Ogni ordine YariNoHanzo viene preparato con cura artigianale prima della spedizione.
                    Di seguito trovi tutte le informazioni su tempi, costi e modalità di consegna.
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">Metodi di spedizione</h5>
                <ul class="text-muted">
                    <li><strong>Spedizione Standard</strong> — 3-5 giorni lavorativi, gratuita sopra i 50€.</li>
                    <li><strong>Spedizione Express</strong> — 1-2 giorni lavorativi, costo aggiuntivo di 9,90€.</li>
                </ul>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">Katane personalizzate</h5>
                <p class="text-muted">
                    Le katane configurate su misura richiedono un tempo di lavorazione artigianale aggiuntivo
                    prima della spedizione, che varia in base alla complessità della configurazione scelta.
                    Riceverai un'email con i dettagli non appena l'ordine è confermato.
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">Tracciamento</h5>
                <p class="text-muted">
                    Non appena il pacco viene affidato al corriere, riceverai una email di conferma.
                    Puoi consultare lo stato di tutti i tuoi ordini in qualsiasi momento dalla sezione
                    <a href="{{ route('user.profile') }}" class="text-danger fw-bold text-decoration-none">Area Personale</a>.
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">Resi</h5>
                <p class="text-muted">
                    Hai 14 giorni di tempo dalla ricezione dell'ordine per richiedere un reso, totale o parziale,
                    direttamente dalla tua Area Personale.
                </p>
            </div>
        </div>
    </div>
</x-layout>