<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Pokémon Finder</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<header>
    <main class="container text-center">
        <a class="a-none" href="{{ route('pokemon.index') }}" onclick="showUiBlock();">
            <p class="header-title-app">Pokémon Finder</p>
        </a>
    </main>
</header>

