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

YARINOHANZO PROJECT

# YariNoHanzo — E-commerce Katana & Arti Marziali

E-commerce completo sviluppato in Laravel 12, con configuratore di katana personalizzate, pagamenti Stripe, sistema di gestione resi e pannello amministrativo.

## Stack tecnico

- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Bootstrap 5, Vite, Tailwind (parziale)
- **Database:** MySQL
- **Pagamenti:** Stripe Checkout
- **Email:** Mailtrap (sviluppo/demo) via coda Laravel

---

## Prerequisiti

Prima di iniziare, assicurati di avere installato:

- **PHP 8.2 o superiore** — verifica con `php -v`
- **Composer** — verifica con `composer -V`
- **Node.js e npm** — verifica con `node -v`
- **MySQL** (consigliato XAMPP per un setup rapido in locale)
- Un account **Stripe** (modalità test) con le chiavi API
- Un account **Mailtrap** (per testare l'invio email senza spedire email reali)

---

## Installazione

### 1. Copia il progetto

Copia l'intera cartella del progetto sulla macchina (o clonala da Git, se versionato). **Non è necessario** portare le cartelle `vendor/` e `node_modules/`: verranno rigenerate al passo successivo.

### 2. Installa le dipendenze

Dalla cartella principale del progetto:

```bash
composer install
npm install
npm run build
```

### 3. Configura l'ambiente

Copia il file di esempio e genera la chiave dell'applicazione:

```bash
cp .env.example .env
php artisan key:generate
```

Apri il file `.env` appena creato e imposta i seguenti valori:

**Database** (adatta a come hai configurato MySQL sulla tua macchina — la porta `3307` è quella usata in sviluppo con XAMPP configurato in modo non standard, il default MySQL è solitamente `3306`):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=yarinohanzo_db
DB_USERNAME=root
DB_PASSWORD=
```

**Stripe** (chiavi di test, dalla dashboard Stripe → Sviluppatori → Chiavi API):

```env
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
```

**Mailtrap** (dalla tua inbox Mailtrap → Integrazione SMTP):

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=...
MAIL_PASSWORD=...
```

> ⚠️ Il file `.env` contiene dati sensibili e **non va mai condiviso o caricato su Git** (è già escluso da `.gitignore`). Va ricreato manualmente su ogni macchina su cui giri il progetto.

### 4. Crea il database

Crea un database MySQL vuoto con lo stesso nome impostato in `DB_DATABASE` (es. `yarinohanzo_db`), poi lancia migration e seeder:

```bash
php artisan migrate:fresh --seed
```

Questo comando crea tutte le tabelle e popola il database con dati demo: prodotti (katane, arti marziali, offerte), utenti di prova, ordini, recensioni, e un paio di richieste di reso già pronte da mostrare.

### 5. Avvia i servizi

Servono **due terminali separati**, entrambi aperti per tutta la durata dell'utilizzo:

**Terminale 1 — server web:**
```bash
php artisan serve
```

**Terminale 2 — worker delle code (necessario per l'invio email):**
```bash
php artisan queue:work
```

> Senza il secondo comando attivo, le email (conferma ordine, conferma reso, notifica katana custom) restano "in coda" e non vengono mai inviate.

Il sito è ora raggiungibile su **http://127.0.0.1:8000**.

---

## Utenti di test

Il seeder crea automaticamente questi utenti (password uguale per tutti: `password`):

| Nome | Email |
|---|---|
| Marco Bianchi | marco.bianchi@example.com |
| Giulia Ferrari | giulia.ferrari@example.com |
| Alessandro Romano | alessandro.romano@example.com |
| Sara Colombo | sara.colombo@example.com |
| Davide Ricci | davide.ricci@example.com |

Ognuno ha almeno un ordine associato; Marco Bianchi e Giulia Ferrari hanno anche una richiesta di reso già presente.

### Promuovere un utente ad amministratore

Per accedere al pannello admin (`/admin/resi`), un utente deve avere `is_admin = true`. Da terminale:

```bash
php artisan tinker
```

Poi, dentro tinker:

```php
User::where('email', 'marco.bianchi@example.com')->update(['is_admin' => true]);
```

---

## Test dei pagamenti (Stripe)

In modalità test, usa questa carta per simulare un pagamento andato a buon fine:

- **Numero carta:** `4242 4242 4242 4242`
- **Data di scadenza:** una qualsiasi data futura
- **CVC:** 3 cifre casuali
- **CAP:** 5 cifre casuali

---

## Struttura delle funzionalità principali

- **Catalogo prodotti:** katane, arti marziali, offerte — con filtri per prezzo, acciaio, materiale
- **Configuratore katana personalizzata:** prezzo calcolato dinamicamente lato server
- **Carrello e checkout:** integrazione Stripe Checkout, prezzi sempre validati server-side
- **Autenticazione:** registrazione, login, verifica email, reset password
- **Area personale cliente:** storico ordini, recensioni fatte, katane configurate, richieste di reso
- **Sistema di reso:** richiesta totale o parziale (per singolo articolo/quantità), scelta metodo di reso, email automatica con etichetta PDF
- **Pannello admin:** gestione e cambio stato delle richieste di reso (`/admin/resi`, solo per utenti con `is_admin = true`)

---

## Note per l'ambiente di produzione (da fare SOLO al momento del deploy reale, non in demo/sviluppo)

Prima di rendere il sito pubblicamente raggiungibile, nel file `.env`:

```env
APP_DEBUG=false
APP_ENV=production
```

Con `APP_DEBUG=true` (valore di sviluppo), in caso di errore Laravel mostra a chiunque visiti il sito lo stack trace completo con percorsi del server e frammenti di codice — va disattivato prima di andare online.

---

## Problemi comuni

**Le email non arrivano:** controlla che `php artisan queue:work` sia in esecuzione in un terminale separato e resti aperto.

**Errore di connessione al database:** verifica che MySQL sia avviato e che `DB_PORT` nel `.env` corrisponda alla porta configurata nel tuo MySQL/XAMPP.

**Pagina bianca o errore 500 senza dettagli:** se `APP_DEBUG=false`, temporaneamente impostalo su `true` per vedere l'errore specifico, controlla `storage/logs/laravel.log`, poi ricordati di rimetterlo su `false` prima di tornare online.



