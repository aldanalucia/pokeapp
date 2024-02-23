# Inicializar proyecto en Docker

### Requisitos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)

### Generar archivo env

- `cp .env.example .env`

### Crear y correr imagen

- `docker build -t pokeapp .`

Una vez creada, inicia la aplicación

- `docker run -d -p 8080:8000 pokeapp:latest`

Podés verlo en http://localhost:8080 o encontrar el contenedor en Docker Desktop.
