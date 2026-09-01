Questa è la versione di Laravel del progetto YariNoHanzo..

Questo progetto è a scopo didattico nulla verrà messo online senza approvazione.. tuttavia la repository sarà pubblica in quanto si accettano commenti, consigli, valutazioni ecc 

06/05/2026 
read.me creato aggiunto vite, e sostituito link bootstrap e js con librerie installate tramite npm. 
Inoltre sono stati introdotti i components per facilitare e semplificare il codice.. 
Components creati:
- navbar
- cards
- layout
- footer

14/05/2026.
- è stato implementato il Maria_DB con Xampp.
- gli array di dati sono stati spostati nel DB ed è stata modificata la logica per le pagine product e offer.  Inoltre sono state create le migration con model e seeder per le categorie katana, MartiaArts e Offers. 

<!-- Scusate.. da un pò non aggiorno il read me. -->

11/06/2026. il sito è quasi completo le modifiche sono le seguenti:
- Aggiunta sidebar con logica per tutte e tre le categorie martial arts, offer, katana  
- Aggiunte sottocategorie modelli katana| abiti e bokken| offer come kaizen, shogun. handmade ecc . tutte switchabili con sidebar
- E' stato riempito il db con nuovi dati per tutte le sottocategorie per test logica
- Aggiunta logica registrazione/login
- Aggiunta logica carrello e pagina articolo Dinamica
- Aggiunta logica Barra di Ricerca Funzionalità prezzo nella sidebar (la barra di ricerca si trova nella navbar) 

16/06/2026
Aggiunte:
- logica form di pagamento per articoli e katana personalizzata con aggiunta di prezzo dinamico
- aggiunta logica recensioni welcome e detail article

19/06/2026
- aggiunta pagina utente e migliorata logica accesso con un pò di css.

<!-- Il sito web è quasi ultimato. -->

08/07/2026
aggiornamento lato front end del sito con stile minimal. leggere il commit

10/07/2026
aggiornamento: modificato stile footer, sidebar e pagina login e register

<!-- REVISIONE -->
24/08/2026
revisione sito web e preparazione demo

- verificato sicurezza e codice per quanto riguarda login, register, personalizza katana, pagina dettaglio, 
- aggiunto form di pagamento tramite stripe
- aggiunto invio email di conferma email, password dimenticata, e di conferma ordine tramite mailtrap

Aggiornamento 29/08/2026 
- raggiunta una struttura solida del sito.

- implemtato logica spedizione expresse o standard in base al costo della spesa.
- aggiunta stile email
- aggiornato stile area personale
- introdotta voce ordini
- possibilità di richiesta reso
- aggiunta freccetta per navigare nel sito

(i procedimenti sono simili creare migration, istruirili, aggiornare i model i controller e le rotte e infine le viste.)

il tutto completa di backend, sicurezza IDOR

Logica reso approfondita. possibilità di selezionare un'articolo in particolare all'interno dell'ordine con invio mail di richiesta e etichetta stampabile tramite link.

aggiornamento 31/08/2026
- completata la modale di reso cambiando la logica di salvataggio e aggiungendo lo stile

(per le mail utilizzare `php artisan queue:work`)

per l'accesso admin qui sotto espongo i passaggi:
1) Avviare il db mysql, il server in locale con `php artisan serve`,avviare il front-end con `npm run dev` e usare `php artisan queue:work` per le mail
2) Creare account sul sito web
3) Andare nel terminale del progetto
4) Scrivere `php artisan tinker`
5) Scrivere `User::where('email', 'email usata per la registrazione')->update(['is_admin' => true]);`
6) L'esito deve essere 1
7) Digitare `exit`

http://127.0.0.1:8000/admin/resi è l'url utilizzato da admin per visionare tutte le richieste di reso



