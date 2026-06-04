<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Lost & found UABCS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="body">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <main class="main h-flex">
        <nav class="nav">
            <ul>
                <li>
                    <a>
                        <img src="" alt="logo" />
                    </a>
                </li>
                <li>Dashboard</li>
                <li>Moderacion</li>
                <li>Acerca</li>
            </ul>
        </nav>
        <section class="content">
            <header>header</header>
            <section class="dashboard-group">
                <!-- <h2>KPIs</h2> -->
                <div class="h-flex kpi-container">
                    <div class="kpi-card card">
                        <i class="fa-solid fa-circle-user"></i>
                        <div>
                            <p>Usuarios activos</p>
                            <h3>{{$userCount}}</h3>
                        </div>
                    </div>

                    <div class="kpi-card card">
                        <i class="fa-solid fa-inbox"></i>
                        <div>
                            <p>Publicaciones</p>
                            <h3>{{$totalPostCount}}</h3>
                        </div>
                    </div>

                    <div class="kpi-card card">
                        <i class="fa-solid fa-handshake-angle"></i>
                        <div>
                            <p>Porcentaje de publicaciones que reciben ayuda</p>
                            <h3>{{$persentageOfPostsHelp}}</h3>
                        </div>
                    </div>

                    <div class="kpi-card card">
                        <i class="fa-solid fa-box"></i>
                        <div>
                            <p>Objetos Recuperados</p>
                            <h3>{{$objectsRetrived}}</h3>
                        </div>
                    </div>
                    <div class="kpi-card card">
                        <i class="fa-solid fa-hourglass"></i>
                        <div>
                            <p>Tiempo promedio de recuperación</p>
                            <h3>{{$avgRetriveTime}}</h3>
                        </div>
                    </div>
                </div>
            </section>
            <section class="dashboard-group">
                <!-- <h2>Graficas</h2> -->
                <!-- <hr> -->
                <!-- <br> -->
                <div class="h-flex">
                    <div id='bars-container'>
                        <x-bar-graphics title="Objetos perdidos por dia de la semana" :chart-data="$objectsPerDayData"></x-bar-graphics>
                        <br>
                        <x-bar-graphics title="Publicaciones mensuales" :chart-data='$postPerMonth'></x-bar-graphics>
                    </div>
                    <div>
                        <x-donut-graphic title="Tipos de objetos" :chart-data='$categoriesData'></x-donut-graphic>
                        <br>
                        <x-donut-graphic title="Post por ubicacion"></x-donut-graphic>
                    </div>
                </div>
            </section>
            <section class="dashboard-group">
                <h2>Leaderboards</h2>
                <div>

                </div>
            </section>

        </section>
    </main>
</body>

</html>
