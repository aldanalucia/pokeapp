@include('partials.button')

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card h-100">
            <div class="card-banner {{ $pokemon['class']['ColorType'] }}">
                <span class="card-info-id-banner">#{{ $pokemon['frontendId'] }}</span>
                <img class="card-img-banner" src="{{ $pokemon['sprite'] }}" alt="{{ $pokemon['name'] }}">
            </div>
            <div class="card-body {{ $pokemon['class']['ColorTypeOpacity'] }}">
                @include('partials.pokemon-info.pokemon-description')
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xl-3 pb-3 pb-xl-0 d-flex flex-column">
                        @include('partials.pokemon-info.pokemon-type')
                        @include('partials.pokemon-info.pokemon-specie')
                        <div class="card mt-3 h-100">
                            <div class="card-body d-flex flex-column justify-content-center">
                                @include('partials.pokemon-info.pokemon-characteristics')
                                @include('partials.pokemon-info.pokemon-abilities')
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xl-6 pb-3 pb-xl-0">
                        @include('partials.pokemon-info.pokemon-stats')
                    </div>
                    <div class="col-sm-12 col-md-12 col-xl-3 d-flex flex-column">
                        @include('partials.pokemon-info.pokemon-evolution')
                        @include('partials.pokemon-info.pokemon-varieties')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@includeIf('partials.modal', ['is_default' => $pokemon['is_default']])
