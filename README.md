# Lost and Found API

## Instalacion y setup

### 0. Instala PHP y composer con el instalador de laravel

https://laravel.com/docs/13.x/installation#installing-php

### 1. Clonar el repo
> git clone https://github.com/Usuario/LostAndFound-API.git

o si usas ssh:
> git clone git@github.com:Usuario/LostAndFound-API.git


### 2. Configurar el .env
> cd seaes

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


