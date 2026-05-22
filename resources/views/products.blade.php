<x-layout>


    <!-- testo principale -->
    <section class="container-fluid my-5 py-5 ">
        <div class="row justify-content-center my-5">
            <div class="col-12 col-md-12">
                <h2 class="text-center">{{ $title }}</h2>
                <h4 class="text-center">{{ $description }}</h4>
            </div>
        </div>
    </section>
    <!-- fine testo -->


    <!-- main card -->
    <main class="container-fluid">
        <div class="row">
            <x-sidebar :type="$type" :subcategories="$subcategories" />
            <div class="col-12 col-md-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($items as $item)
                    <div class="col">
                        <x-cards :katana="$item" />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <!-- fine main card -->


</x-layout>
