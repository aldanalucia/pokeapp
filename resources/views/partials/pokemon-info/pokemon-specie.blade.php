@if (isset($pokemon['species']['habitat']))
    <div class="card mt-3 h-100">
        <div class="card-body d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-6 {{ $pokemon['class']['ColorTypeText'] }}">Habitat</div>
                <div class="col-6">{{ $pokemon['species']['habitat']['name'] }}</div>
            </div>
            <div class="row">
                <div class="col-6 {{ $pokemon['class']['ColorTypeText'] }}">Specie</div>
                <div class="col-6">{{ $pokemon['species']['name'] }}</div>
            </div>
        </div>
    </div>
@endif
