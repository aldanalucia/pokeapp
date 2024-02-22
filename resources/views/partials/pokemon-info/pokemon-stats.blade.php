<div class="card h-100">
    <div class="card-body d-flex flex-column justify-content-center">
        @foreach($pokemon['stats'] as $stats)
            <div class="row">
                <div class="col-5 col-md-6">
                    <p class="{{ $pokemon['class']['ColorTypeText'] }}">{{ $stats['stat']['name'] }}</p>
                </div>
                <div class="col-2 col-md-1">{{ $stats['base_stat'] }}</div>
                <div class="col-5">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $stats['base_stat'] }}%" aria-valuenow="{{ $stats['base_stat'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
