let linkdark = document.querySelector('#darkicon');
let body = document.querySelector('body');

// --- 1. RECUPERO AL CARICAMENTO ---
// Controlliamo se nel localStorage esiste già la preferenza "dark"
if (localStorage.getItem('tema') === 'dark') {
    body.classList.add('dark-mode');
}

// --- 2. LOGICA AL CLICK ---
linkdark.addEventListener('click', (event) => {
    event.preventDefault();

    // Applichiamo/rimuoviamo la classe
    body.classList.toggle('dark-mode');

    // --- 3. SALVATAGGIO DELLA PREFERENZA ---
    // Se dopo il click il body ha la classe dark-mode, salviamo 'dark'
    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('tema', 'dark');
    } else {
        // Altrimenti salviamo 'light' (o cancelliamo la chiave)
        localStorage.setItem('tema', 'light');
    }
});

// funzioni carrello e aggiungi al carrello
// fine funzioni carrello e aggiungi al carrello


// Funzione per mostrare/nascondere la password

document.addEventListener('DOMContentLoaded', function () {

    function setupPasswordToggle(buttonId, inputId, iconId) {
        const toggleBtn = document.getElementById(buttonId);
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);

        // Eseguiamo il codice solo se gli elementi esistono nella pagina attuale
        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    // Cambia la classe di Bootstrap Icons da occhio normale a occhio sbarrato
                    if (eyeIcon) {
                        eyeIcon.classList.remove('bi-eye');
                        eyeIcon.classList.add('bi-eye-slash');
                    }
                } else {
                    passwordInput.type = 'password';
                    // Torna all'occhio normale
                    if (eyeIcon) {
                        eyeIcon.classList.remove('bi-eye-slash');
                        eyeIcon.classList.add('bi-eye');
                    }
                }
            });
        }
    }

    // 1. Attiva l'occhio per la Password Principale
    // (Assicurati che nel form il button abbia id="togglePassword", l'input id="passwordInput" e l'icona id="eyeIcon")
    setupPasswordToggle('togglePassword', 'passwordInput', 'eyeIcon');

    // 2. Attiva l'occhio per la Conferma Password (Nuovo!)
    setupPasswordToggle('togglePasswordConfirmation', 'password_confirmation', 'eyeIconConfirmation');
});


// logica recensioni
document.addEventListener('DOMContentLoaded', function () {
    const reviewForm = document.getElementById('reviewForm');
    
    if (reviewForm) {
        reviewForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Blocca il refresh della pagina

            const productId = document.getElementById('productId').value;
            const rating = document.getElementById('reviewRating').value;
            const comment = document.getElementById('reviewComment').value;
            
            // Recuperiamo il token CSRF dal meta tag del tuo layout
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const messageDiv = document.getElementById('reviewMessage');

            const data = {
                product_id: productId,
                rating: rating,
                comment: comment
            };

            // Invio asincrono al controller Laravel
            fetch('/api/reviews', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) throw new Error('Errore nel salvataggio');
                return response.json();
            })
            .then(res => {
                if (res.review) {
                    // 1. Mostra il banner di successo
                    messageDiv.className = "mt-3 alert alert-success border-0 shadow-sm";
                    messageDiv.textContent = res.message;
                    messageDiv.classList.remove('d-none');
                    
                    // 2. Svuota i campi del form
                    reviewForm.reset();

                    // 3. Rimuovi il testo di "Nessuna recensione" se presente
                    const noReviewsText = document.getElementById('noReviewsText');
                    if (noReviewsText) noReviewsText.remove();

                    // 4. Genera le stelline grafiche
                    const stars = '⭐'.repeat(res.review.rating);

                    // 5. Costruisci la nuova recensione da inserire subito nella pagina
                    const newReviewHtml = `
                        <div class="card shadow-sm border-0 p-2 bg-white" style="border-left: 4px solid #198754 !important;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong class="text-uppercase" style="font-family: 'Oswald', sans-serif;">
                                        <i class="bi bi-person-fill me-1"></i>${res.review.user.name}
                                    </strong>
                                    <span class="text-warning">${stars}</span>
                                </div>
                                <p class="mb-0 text-dark mt-2">"${res.review.comment}"</p>
                                <div class="text-end mt-2">
                                    <small class="text-success fw-bold" style="font-size: 0.75rem;">Appena inserita</small>
                                </div>
                            </div>
                        </div>
                    `;

                    // La inserisce in cima alla lista delle recensioni
                    document.getElementById('reviewsContainer').insertAdjacentHTML('afterbegin', newReviewHtml);
                }
            })
            .catch(error => {
                console.error('Errore:', error);
                messageDiv.className = "mt-3 alert alert-danger border-0 shadow-sm";
                messageDiv.textContent = "Impossibile inviare la recensione. Riprova più tardi.";
                messageDiv.classList.remove('d-none');
            });
        });
    }
});

// Caricamento recensioni home
document.addEventListener('DOMContentLoaded', function () {
    const latestContainer = document.getElementById('latestReviewsContainer');
    const reviewsLoader = document.getElementById('reviewsLoader');

    // Eseguiamo il codice SOLO se ci troviamo nella Home Page (dove esistono questi ID)
    if (latestContainer && reviewsLoader) {
        fetch('/api/latest-reviews')
            .then(response => {
                if (!response.ok) throw new Error('Impossibile caricare le recensioni');
                return response.json();
            })
            .then(reviews => {
                // Rimuoviamo lo spinner di caricamento
                reviewsLoader.remove();

                // Se non ci sono ancora recensioni nel DB
                if (reviews.length === 0) {
                    latestContainer.innerHTML = `
                        <div class="col-12 text-center text-muted">
                            <p class="mb-0">Non ci sono ancora recensioni. Sii il primo a lasciare un feedback!</p>
                        </div>
                    `;
                    return;
                }

                // Cicliamo le ultime recensioni ricevute dal controller
                reviews.forEach(review => {
                    const stars = '⭐'.repeat(review.rating);
                    
                    const cardHtml = `
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card w-100 shadow-sm border-0 p-3 bg-white d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <strong class="text-uppercase" style="font-family: 'Oswald', sans-serif;">
                                            <i class="bi bi-person-fill me-1"></i>${review.user.name}
                                        </strong>
                                        <span class="text-warning">${stars}</span>
                                    </div>
                                    <p class="mb-0 text-muted fst-italic">"${review.comment || 'Nessun commento scritto.'}"</p>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    // Inseriamo la card nel container della Home
                    latestContainer.insertAdjacentHTML('beforeend', cardHtml);
                });
            })
            .catch(error => {
                console.error('Errore:', error);
                if (reviewsLoader) reviewsLoader.remove();
                latestContainer.innerHTML = `
                    <div class="col-12 text-center text-danger">
                        <p class="mb-0">Si è verificato un errore nel caricamento delle recensioni.</p>
                    </div>
                `;
            });
    }
});
