<x-layout>
    <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <h2 class="fw-bold mb-4" style="font-family: 'Oswald', sans-serif;">Termini e Condizioni</h2>

                <p class="text-muted mb-4">
                    Ultimo aggiornamento: {{ date('d/m/Y') }}
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">1. Oggetto</h5>
                <p class="text-muted">
                    Le presenti condizioni generali regolano la vendita dei prodotti offerti sul sito YariNoHanzo,
                    incluse katane standard, katane personalizzate e articoli per arti marziali.
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">2. Prodotti e prezzi</h5>
                <p class="text-muted">
                    Tutti i prezzi sono espressi in Euro e comprensivi di IVA, dove applicabile. Per le katane
                    personalizzate, il prezzo finale viene calcolato in base alle opzioni selezionate in fase di
                    configurazione ed è mostrato chiaramente prima della conferma d'ordine.
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">3. Pagamenti</h5>
                <p class="text-muted">
                    I pagamenti vengono elaborati tramite Stripe, un fornitore di servizi di pagamento sicuro e
                    certificato. YariNoHanzo non memorizza in alcun modo i dati della carta di credito.
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">4. Diritto di reso</h5>
                <p class="text-muted">
                    Hai diritto a richiedere il reso, totale o parziale, entro 14 giorni dalla ricezione
                    dell'ordine, direttamente dalla tua Area Personale. Le modalità e i tempi sono descritti
                    nella pagina <a href="{{ route('spedizioni') }}" class="text-danger fw-bold text-decoration-none">Spedizioni</a>.
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">5. Katane personalizzate</h5>
                <p class="text-muted">
                    Data la natura artigianale e su misura delle katane personalizzate, YariNoHanzo si riserva il
                    diritto di valutare caso per caso le richieste di reso relative a questi prodotti. Contattare YariNoHanzo tramite mail <span class="text-danger fw-bold">info@yarinohanzo.it</span> per discutere eventuali resi o modifiche.
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">6. Account utente</h5>
                <p class="text-muted">
                    La registrazione di un account richiede dati corretti e aggiornati. Ogni utente è responsabile
                    della riservatezza delle proprie credenziali di accesso.
                </p>

                <h5 class="fw-bold mt-4 mb-2" style="font-family: 'Oswald', sans-serif;">7. Contatti</h5>
                <p class="text-muted">
                    Per qualsiasi domanda relativa ai presenti termini, puoi contattarci tramite la pagina
                    <a href="{{ route('contattaci') }}" class="text-danger fw-bold text-decoration-none">Contattaci</a>.
                </p>
            </div>
        </div>
    </div>
</x-layout>