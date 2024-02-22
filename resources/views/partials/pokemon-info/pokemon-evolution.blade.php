<div class="card h-100">
    <div class="card-body d-flex flex-column justify-content-center">
        <div class="row">
            <p class="{{ $pokemon['class']['ColorTypeText'] }}">Evolution</p>
            @if (isset($pokemon['evolution']))
                @foreach($pokemon['evolution'] as $chain)
                    <div class="col-6 {{ $pokemon['class']['ColorTypeText'] }}">{{ $chain['require_to_evolve'] }}</div>
                    <div class="col-6">
                        <a class="card-a" onclick="showUiBlock();" href="{{ route('pokemon.search.name', ['name' => $chain['name']]) }}">{{ $chain['name'] }}</a>
                    </div>
                @endforeach
            @else()
                <div class="col-12">
                    <span class="badge rounded-pill w-100 {{ $pokemon['class']['ColorTypeOpacity'] }}">None</span>
                </div>
            @endif
        </div>
    </div>
</div>
