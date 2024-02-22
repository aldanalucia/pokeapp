<div class="row">
    <div class="col-6 {{ $pokemon['class']['ColorTypeText'] }}">Abilities</div>
    <div class="col-6">
        @foreach($pokemon['abilities'] as $abilities)
            {{ $abilities['ability']['name'] }}
            @if (!$loop->last)
                ,
            @endif
        @endforeach
    </div>
</div>
