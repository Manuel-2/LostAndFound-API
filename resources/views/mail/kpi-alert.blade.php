<x-mail::message>
# Alerta publicaciones

## {{$date}}
Se han detectado una alta incidencia de publicaciones, revisa el dashboard.

<x-mail::button :url="route('dashboard')">
Ir al dashboard
</x-mail::button>

<br>
{{ config('app.name') }}
</x-mail::message>
