<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @vite(['resources/css/login.css'])
    <title>Recuperar contraseña| Lost & found - Administradción</title>
</head>

<body
    <main class="main">
    <div class="left">
        <div class="card kpi-card">
            <h1>Lost and Found</h1>
            <h2 style="text-align: center;">
                Recuperar contraseña
                <br>
                <i class="fa-solid fa-key"></i>
            </h2>
            @if(session('message'))
            <div>
                <p> {{session('message')}}</p>
            </div>
            @endif
            <hr>
            <br>
            <form method="post" action="/recover">
                @csrf
                <label>
                    <p>Correo</p>
                    <input type="email" name="email">
                </label>
                <input id="send" type="submit" value="Enviar Correo de recuperacion"></input>
            </form>
            <a href='/login'>Login</a>
        </div>
    </div>
    <div>
        <h2>Lost and found</h2>
        <i class="fa-solid fa-box-open"></i>
    </div>
    </main>


</body>

</html>
