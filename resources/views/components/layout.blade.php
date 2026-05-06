<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YariNoHanzo</title>

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


    <!-- footer -->
    <x-footer />

    <!-- vite js -->
    @vite('resources/js/app.js')
</body>

</html>
