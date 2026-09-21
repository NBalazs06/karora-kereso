<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karóra kereső</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
</head>
<body>
    <header><a href="{{ url('/') }}" class="header-link" id="oldal-nev">Karóra kereső</a></header>

    @yield('katalogus')
    @yield('karora_reszletes_info')

    <footer>Készítette: Novák Balázs Mátyás</footer>
    <script src="{{ asset('js/keret.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>