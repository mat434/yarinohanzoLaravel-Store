<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YariNoHanzo</title>

    {{-- icona --}}
    <link rel="icon" type="image/png" href="{{ asset('favICO.png') }}">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">


    <!-- vite css -->
    @vite('resources/css/app.css')
</head>

<body>
    <!-- navbar -->
    <x-navbar />
    {{ $slot }}

    @if (session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100; margin-top: 90px;">
            <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 bg-white p-3" role="alert" style="min-width: 320px; border-left: 5px solid #198754 !important;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Operazione Completata</h6>
                        <small class="text-muted">{{ session('success') }}</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- footer -->
    <x-footer />

    <!-- vite js -->
    @vite('resources/js/app.js')
</body>

</html>
