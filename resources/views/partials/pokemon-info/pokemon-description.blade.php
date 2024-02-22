<div class="mb-3">
    <h6 class="card-title fw-bolder mt-3 mt-md-0 ">{{ $pokemon['name'] }}</h6>

    @if (isset($pokemon['species']) && !empty($pokemon['species']['flavor_text_entries']))

        <div class="col-12 col-md-4">
            @foreach($pokemon['species']['flavor_text_entries'] as $flavorText)
                @if ($flavorText['language']['name'] == 'en')
                    @php $description = $flavorText['flavor_text']; @endphp
                    @break
                @endif
            @endforeach
            <h6 class="small">{{  Str::ascii($description) ?? ''}}</h6>
        </div>
    @endif
</div>
