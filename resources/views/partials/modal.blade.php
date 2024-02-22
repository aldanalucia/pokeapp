@if ($is_default)
    <div class="modal fade" id="varietiesPokemons" tabindex="-1" aria-labelledby="varietiesPokemonsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="text-uppercase m-0 {{ $pokemon['class']['ColorTypeText'] }}">Varieties</h6>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach($pokemon['species']['varieties'] as $variety)
                        @if (!$variety['is_default'])
                            <p><a class="card-a" onclick="showUiBlock(1);" href="{{ route('pokemon.search.name', ['name' => $variety['pokemon']['name']]) }}">{{ $variety['pokemon']['name'] }}</a></p>
                        @endif
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif
