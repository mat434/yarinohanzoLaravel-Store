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
