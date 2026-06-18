// Dark Mode
let linkdark = document.querySelector('#darkicon');
let body = document.querySelector('body');

// Recupero al caricamento: controlliamo se nel localStorage esiste già la preferenza "dark"
if (localStorage.getItem('tema') === 'dark') {
    body.classList.add('dark-mode');
}

// Logica al click sull'icona
if (linkdark) {
    linkdark.addEventListener('click', (event) => {
        event.preventDefault();
        body.classList.toggle('dark-mode');

        // Salvataggio della preferenza
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('tema', 'dark');
        } else {
            localStorage.setItem('tema', 'light');
        }
    });
}

// 2 mostra password al click sull'occhio (Password e Conferma)
document.addEventListener('DOMContentLoaded', function () {
    function setupPasswordToggle(buttonId, inputId, iconId) {
        const toggleBtn = document.getElementById(buttonId);
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    if (eyeIcon) {
                        eyeIcon.classList.remove('bi-eye');
                        eyeIcon.classList.add('bi-eye-slash');
                    }
                } else {
                    passwordInput.type = 'password';
                    if (eyeIcon) {
                        eyeIcon.classList.remove('bi-eye-slash');
                        eyeIcon.classList.add('bi-eye');
                    }
                }
            });
        }
    }

    // Attiva l'occhio per la Password Principale e Conferma
    setupPasswordToggle('togglePassword', 'passwordInput', 'eyeIcon');
    setupPasswordToggle('togglePasswordConfirmation', 'password_confirmation', 'eyeIconConfirmation');
});

// 3 logica recensioni polimorfiche (Katana, Offerta, Articolo)
document.addEventListener('DOMContentLoaded', function () {
    const reviewForm = document.getElementById('reviewForm');
    
    if (reviewForm) {
        reviewForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Blocca il refresh della pagina

            // Recuperiamo ID e Tipo dai data-attributes del form polimorfico
            const reviewableId = reviewForm.getAttribute('data-reviewable-id');
            const reviewableType = reviewForm.getAttribute('data-reviewable-type');
            
            const rating = document.getElementById('reviewRating').value;
            const comment = document.getElementById('reviewComment').value;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const messageDiv = document.getElementById('reviewMessage');

            const data = {
                reviewable_id: reviewableId,
                reviewable_type: reviewableType,
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
                    // Mostra il banner di successo
                    messageDiv.className = "mt-3 alert alert-success border-0 shadow-sm";
                    messageDiv.textContent = res.message;
                    messageDiv.classList.remove('d-none');
                    
                    // Svuota i campi del form
                    reviewForm.reset();

                    // Rimuovi il testo di "Nessuna recensione" se presente
                    const noReviewsText = document.getElementById('noReviewsText');
                    if (noReviewsText) noReviewsText.remove();

                    // Genera le stelline grafiche
                    const stars = '⭐'.repeat(res.review.rating);

                    // Costruisci la nuova recensione da inserire subito nella pagina
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

// Sezione 4 - Caricamento delle ultime recensioni in homepage
document.addEventListener('DOMContentLoaded', function () {
    const latestContainer = document.getElementById('latestReviewsContainer');
    const reviewsLoader = document.getElementById('reviewsLoader');

    if (latestContainer && reviewsLoader) {
        fetch('/api/latest-reviews')
            .then(response => {
                if (!response.ok) throw new Error('Impossibile caricare le recensioni');
                return response.json();
            })
            .then(reviews => {
                reviewsLoader.remove();

                if (reviews.length === 0) {
                    latestContainer.innerHTML = `
                        <div class="col-12 text-center text-muted">
                            <p class="mb-0">Non ci sono ancora recensioni. Sii il primo a lasciare un feedback!</p>
                        </div>
                    `;
                    return;
                }

                reviews.forEach(review => {
                    const stars = '⭐'.repeat(review.rating);
                    
                    // 1. Recuperiamo in sicurezza il nome dell'oggetto polimorfico (Katana, Offerta o Articolo)
                    // (Usa .name o .title a seconda di come hai chiamato la colonna nel tuo DB)
                    const itemReviewed = review.reviewable ? (review.reviewable.nome || review.reviewable.titolo|| 'Articolo') : 'Articolo';
                    // 2. Integriamo le tue classi custom per il supporto Dark Mode
                    const cardHtml = `
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card w-100 shadow-sm border-0 p-3 bg-white d-flex flex-column justify-content-between custom-review-card">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong class="text-uppercase custom-comment" style="font-family: 'Oswald', sans-serif;">
                                            <i class="bi bi-person-fill me-1"></i>${review.user.name}
                                        </strong>
                                        <span class="text-warning">${stars}</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <small class="fw-bold custom-type text-muted">
                                            <i class="bi bi-tags-fill me-1"></i>Recensione su: <span class="text-success">${itemReviewed}</span>
                                        </small>
                                    </div>

                                    <p class="mb-0 text-muted fst-italic custom-date">"${review.comment || 'Nessun commento scritto.'}"</p>
                                </div>
                            </div>
                        </div>
                    `;
                    
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