<!-- inizio footer -->
<footer class="container-fluid custom-footer">
    <div class="row justify-content-around align-items-start pt-5 pb-4">
        {{-- Colonna Informazioni / Brand --}}
        <div class="col-12 col-md-4 mb-4 mb-md-0">
            <h5 class="footer-title text-uppercase mb-3">YariNoHanzo</h5>
            <p class="footer-text">
                Forgiamo passioni. Strumenti di alta qualità per la pratica dello Iaido, 
                Kendo e del Collezionismo. Ogni lama racconta una storia di tradizione e precisione geometrica.
            </p>
        </div>
        
        {{-- Colonna Link Utili e Social --}}
        <div class="col-12 col-md-3">
            <h5 class="footer-title text-uppercase mb-3">Link Utili</h5>
            <ul class="list-unstyled footer-links-list">
                <li class="mb-2"><a class="footer-link" href="">Contattaci</a></li>
                <li class="mb-2"><a class="footer-link" href="">Spedizioni</a></li>
                <li class="mb-2"><a class="footer-link" href="">Termini e condizioni</a></li>
                <li class="mb-2">
                    <a class="footer-link d-inline-flex align-items-center" href="https://www.instagram.com/yarinohanzoswords/" target="_blank">
                        Instagram <i class="bi bi-instagram ms-2"></i>
                    </a>
                </li>
                <li class="mb-2">
                    <a class="footer-link d-inline-flex align-items-center" href="https://www.facebook.com/YariNoHanzoKatana/?locale=it_IT" target="_blank">
                        Facebook <i class="bi bi-facebook ms-2"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Micro-barra dei crediti finale --}}
    <div class="row custom-sub-footer py-3">
        <div class="col-12 text-center">
            <p class="mb-0 text-uppercase footer-credits">© {{ date('Y') }} YariNoHanzo - Tutti i diritti riservati.</p>
        </div>
    </div>
</footer>
<!-- fine footer -->
