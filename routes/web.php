<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('index'); })->name('pokemon.index');
Route::get('/search', [PokemonController::class, 'search'])->name('pokemon.search');
Route::get('/search/pokemon', [PokemonController::class, 'searchPokemon'])->name('pokemon.search.name');
