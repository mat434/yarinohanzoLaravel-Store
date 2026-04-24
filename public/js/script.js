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
