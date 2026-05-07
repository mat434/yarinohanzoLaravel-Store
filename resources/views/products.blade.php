<x-layout>


    <!-- testo principale -->
    <section class="container-fluid my-5 py-5 ">
        <div class="row justify-content-center my-5">
            <div class="col-12 col-md-12">
                <h2 class="text-center">{{ $titolo }}</h2>
                <h4 class="text-center">{{ $description }}</h4>
            </div>
        </div>
    </section>
    <!-- fine testo -->


    <!-- main card -->
    <main class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-3">
                <ul class="list-group me-5 pe-4">
                    <li class="list-group-item"><a href="">sotto categoria 1</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 2</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 3</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 4</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 5</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 6</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 7</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 8</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 9</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 10</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 11</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 12</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 13</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 14</a></li>
                    <li class="list-group-item"><a href="">sotto categoria 15</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($offerte as $katana)
                    <div class="col">
                        <x-cards :katana="$katana" />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <!-- fine main card -->


</x-layout>
