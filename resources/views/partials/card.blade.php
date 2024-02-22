<div class="row">
    @foreach($pokemonsPaginated->items() as $pokemon)
        <div class="col-md-3 mb-3">
            <div class="card card-item h-100">
                <a class="card-a" href="{{ route('pokemon.search.name', ['name' => $pokemon['name']]) }}" onclick="showUiBlock();">
                    <div class="card-body card-body-item">
                        <p class="small p-0 fs-6">#{{ $pokemon['frontendId'] }}</p>
                        <img class="card-img" src="{{ $pokemon['sprite'] }}" alt="{{ $pokemon['name'] }}">
                        <h6 class="card-title fw-bolder">{{ $pokemon['name'] }}</h6>
                        @foreach($pokemon['types'] as $type)
                            <span class="badge rounded-pill {{ $type['type']['name'] }}-type">{{ $type['type']['name'] }}</span>
                        @endforeach
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>
