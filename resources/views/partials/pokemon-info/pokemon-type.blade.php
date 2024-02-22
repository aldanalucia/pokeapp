<div class="card h-100">
    <div class="card-body d-flex flex-column justify-content-center">
        <div class="row">
            @foreach($pokemon['types'] as $type)
                <div class="col-3">
                    <span class="badge rounded-pill {{ $type['type']['name'] }}-type">{{ $type['type']['name'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
