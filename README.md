# Lost and Found API

## Instalacion y setup

### 0. Instala PHP y composer con el instalador de laravel

https://laravel.com/docs/13.x/installation#installing-php

Incrementa el limite del tamaño del cuerpo en el servidor HTTP de php
para eso ejecuta:

> php --ini


te a imprimir una o varias rutas donde se encuentra el archivo de configuracion de tu instalacion de php
elije la que se este usando o este loaded y abre dicho archivo
y agrega las siguientes dos lineas:

upload_max_filesize = 50M
post_max_size = 55M


### 1. Clonar el repo
> git clone https://github.com/Usuario/LostAndFound-API.git

o si usas ssh:
> git clone git@github.com:Usuario/LostAndFound-API.git


### 2. Configurar el .env
entra en el repo y copia el archivo .env.example y renombralo .env
> cp .env.example .env

Y en las lineas: 
>DB_USERNAME=root

>DB_PASSWORD=

Establecer usuario y contraseña de tu mariadb

### 3. Ejecutar los comandos
> composer update

> npm install

> php artisan migrate --seed

> php artisan key:generate

### 4. Lanzar servidor de desarrollo
> composer run dev

Nota: todo está en localhost:8000/api


