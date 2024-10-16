<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon site Laravel')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <header>
        <img src="{{ asset('images/Logo-esi.png') }}" alt="logo he2b esi">
        <div>
            <div class="header-title">
                @yield('titre_page')
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">Accueil</a>
                    </li>
                    <li>
                        <a href="{{ url('/students') }}">Liste des Étudiants</a>
                    </li>                
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>HE2B-ÉSI / PRJG5 / 2024-2025</p>
    </footer>

</body>
</html>
