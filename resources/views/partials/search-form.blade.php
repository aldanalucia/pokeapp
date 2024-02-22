<form action="{{ route('pokemon.search') }}" method="GET" class="mb-4" id="formPokemonSearch" onsubmit="showUiBlock();">
    <p>El que quiera Pokémons, que los busque</p>
    <div class="row">
        <div class="col-xs-12 col-md-6 pb-3 pb-md-0">
            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese nombre a buscar" autocomplete="off" value="{{ $_GET['name'] ?? '' }}">
        </div>
        <div class="col-xs-12 col-md-3 pb-3 pb-md-0">
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
</form>
