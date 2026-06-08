@extends('layout.app')


@section('title','Dashboard')

@section('content')
<section class="dashboard-group" id="kpis">
        <div class="kpi-container">
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
          <div class="kpi-card card">
            <i class="fa-solid fa-question"></i>
            <div>
              <p>Publicaciones de objetos perdidos</p>
              <h3>{{$lostPosts}}</h3>
            </div>
          </div>
          <div class="kpi-card card">
            <i class="fa-solid fa-magnifying-glass"></i>
            <div>
              <p>Publicaciones de objetos encontrados</p>
              <h3>{{$foundPosts}}</h3>
            </div>
          </div>
          <div class="kpi-card card">
            <i class="fa-solid fa-tag"></i>
            <div>
              <p>Categoria mas popular</p>
              <h3>{{$popularType}}</h3>
            </div>
          </div>
          <div class="kpi-card card">
            <i class="fa-solid fa-location-arrow"></i>
            <div>
              <p>Ubicacion mas popular</p>
              <h3>{{$popularLoc}}</h3>
            </div>
          </div>
          <div class="kpi-card card">
            <i class="fa-solid fa-bell"></i>
            <div>
              <p>Solicitudes pendientes</p>
              <h3>{{$pendingRequest}}</h3>
            </div>
          </div>
        </div>
      </section>
      <section class="dashboard-group">
        <h2>Graficas</h2>
        <hr>
        <br>
        <br>
        <div id="graphics">
          <x-bar-graphics title="Objetos perdidos esta semana" :chart-data="$objectsPerDayData" indicator=9></x-bar-graphics>
          <x-donut-graphic title="Tipos de objetos" :chart-data='$categoriesData'></x-donut-graphic>
          <x-bar-graphics title="Publicaciones mensuales" :chart-data='$postPerMonth'></x-bar-graphics>
          <x-donut-graphic title="Distribución top 5 ubicaciones más recurrentes" :chart-data='$top5LocationsData'></x-donut-graphic>
        </div>
        </div>
      </section>
    </section>

@endsection
