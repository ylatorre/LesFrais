<!doctype html>
<html lang="en">
<head>
    <nav class="container navbar navbar-expand-lg fixed-top navbar-dark bg-primary" aria-label="Main navigation">


        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('entreprise') }}">Entreprise</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Modifier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Valider</a>
                </li>

            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

    </nav>

    <div class="container">

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>@yield('title')</title>
</head>
<body>

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <footer style="text-align: center; background:rgb(33, 119, 233);color:aliceblue;">
        <p>Author:Rami KHADDOUR<br>
            <a href="ramikhaddour@gmail.com">ramikhaddour@gmail.com</a></p>
    </footer>
    </div>
</body>
</html>
