<p align="center"><a href="https://pokeapi.co/"><img src="https://raw.githubusercontent.com/PokeAPI/media/master/logo/pokeapi_256.png" alt="PokeApi"></a></p>

# Pokémon Finder

Este proyecto es una aplicación web realizada con la APIRest [PokeApi](https://pokeapi.co/) para proporcionar información de Pokémons, como sus características, habilidades y más. Permite búsquedas por nombres parciales o específicos para encontrar a tu pokémon preferido.

## Documentación

### Tecnologías

Laravel Framework 10.45.1

Bootstrap 5.1.3

### Endpoints utilizados

- Listado y características de los pokémons
    
    https://pokeapi.co/api/v2/pokemon/


- Información de cada pokémon

  https://pokeapi.co/api/v2/pokemon-species/


- Evolución de una especie de pokémon
  
    https://pokeapi.co/api/v2/evolution-chain/

## Iniciar proyecto en Docker

Leer README.Docker

## Instalar proyecto

### Requisitos

- [PHP Apache v. ^8.1](https://www.apachefriends.org/es/index.html)

- [Composer](https://getcomposer.org/download/)

- [Git](https://git-scm.com/downloads)

### Instalación

#### Clonar repositorio 

- `git clone https://github.com/aldanalucia/pokeapp.git`

#### Instalar dependencias

- `composer install`

#### Generar archivo env

- `cp .env.example .env`

#### Generar key

- `php artisan key:generate`

## Iniciar proyecto

- `php artisan serve`

