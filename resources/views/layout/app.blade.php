<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Lost & Found')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="body">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <main class="main h-flex">

        <nav class="nav">
            <ul>
                <li id="logo">
                    <a>
                        <h4>Lost and found</h4>
                        <i class="fa-solid fa-box-open"></i>
                    </a>
                </li>
                <li><a href="/dashboard">Dahsboard</a></li>
                <li><a href="/reports">Moderation</a></li>
                <li><a href="/users">Usuarios</a></li>
                <li><a href="/posts">Publicaciones</a></li>
                <li><a href="/logout">Cerrar Sesión</a></li>
            </ul>
        </nav>

        <section class="content">
            <header>
                <h1> @yield('title') <span>  </span></h1>
            </header>
            @yield('content')
        </section>

    </main>
</body>

</html>
