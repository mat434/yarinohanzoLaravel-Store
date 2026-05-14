<x-layout>
    <div class="container-fluid">
        <div class="col-12 col-md-12 mt-5 text-center py-5">
            <h1>Accedi a Yari No Hanzo</h1>
        </div>
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <!--Immagine -->
            <div class="col-md-5 d-flex justify-content-center align-items-center">
                <img src="{{ asset('immagini/fukushima.jpg') }}" class="img-fluid rounded shadow" alt="Forgia Katana">
            </div>
            <!-- DIVIDER -->
            <div class="d-none d-md-block" style="border-left: 2px solid #dee2e6; height: 400px; width: 0px; padding: 0;">
            </div>
            {{-- FINE DIVIDER  --}}
            <!-- Form -->
            <div class="col-md-5 p-5">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <h2 class="mb-4">Accedi alla Forgia</h2>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" required
                            value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Conferma Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Accedi</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
