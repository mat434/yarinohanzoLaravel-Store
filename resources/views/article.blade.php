<x-layout>

    <!-- inizio paragraph -->
    <section class="container-fluid my-5 py-5">
        <div class="row my-2 justify-content-start align-items-center">
            <div class="col-12 col-md-6">
                {{-- carousel --}}
                <div id="carouselExampleIndicators" class="carousel slide caroarticle">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/caroimg/caro1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/caroimg/caro2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/caroimg/caro3.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                {{-- fine carousel --}}
            </div>
            <div class="col-12 col-md-6 text-end">
                <h3>Shiruya Haji</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt reiciendis amet asperiores ducimus
                    totam adipisci veritatis! Delectus odit numquam odio omnis deleniti maiores vel. Ipsam modi, ea
                    inventore quia non atque voluptatem animi facilis nisi esse repellendus error sunt fugiat, sit
                    blanditiis necessitatibus libero accusamus quas ab nam ex maiores consectetur quis reiciendis?
                    Dolor, mollitia aspernatur sint corrupti eius, animi sapiente eveniet nobis deleniti impedit eum,
                    quasi temporibus cupiditate. Error quas, illo quis iure et voluptatem nesciunt ratione veritatis.
                    Repellat ab neque totam natus hic quia recusandae voluptatem. Veniam vel voluptates odio nobis
                    corporis temporibus a asperiores vitae reprehenderit expedita nesciunt rerum adipisci ratione non
                    cupiditate quam, labore saepe fugiat quasi molestiae libero ea iste quisquam. Totam ut mollitia
                    nobis voluptas, aspernatur laborum explicabo voluptate, libero ipsum, odio recusandae atque quia!
                    Illo sunt nisi dignissimos nobis incidunt soluta similique. Quaerat dicta itaque blanditiis ab
                    culpa! Dignissimos maiores soluta error provident!
                </p>
            </div>
        </div>
    </section>
    <!-- fine paragraph -->

    <!-- section dettagli -->
    <section class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">
                <ul class="list-group">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item">And a fifth one</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item">And a fifth one</li>
                </ul>
            </div>
            <div class="col-12 col-md-6 my-2 text-end">
                <ul class="ulpay">
                    <li class="my-2">Costo 125,00 euro</li>
                </ul>
                <button class="btn btn-warning">Aggiungi al carrello</button>
            </div>
        </div>
        </div>
    </section>
    <!-- fine section dettagli -->

</x-layout>
