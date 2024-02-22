<div class="card mt-3 h-100">
    <div class="card-body d-flex flex-column justify-content-center">

        <p class="{{ $pokemon['class']['ColorTypeText'] }}">Varieties</p>

        {{--  Incluye el default --}}
        @if (isset($pokemon['species']['varieties']) && count($pokemon['species']['varieties']) > 1)
            <button type="button" class="badge rounded-pill bg-primary border-0 text-uppercase"
                    data-bs-toggle="modal" data-bs-target="#varietiesPokemons">
                Show
            </button>
        @elseif(!$pokemon['is_default'])
            <span class="badge rounded-pill {{ $pokemon['class']['ColorType'] }}">Type of variety</span>
        @else
            <span class="badge rounded-pill {{ $pokemon['class']['ColorTypeOpacity'] }}">None</span>
        @endif
    </div>
</div>
