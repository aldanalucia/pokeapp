@extends('layouts.container')

@section('content')

    @include('partials.search-form')
    @includeWhen(!isset($message) && !isset($pokemonsPaginated), 'partials.blank-form')
    @includeWhen(isset($message), 'partials.message')
    @if(isset($pokemonsPaginated))
        @include('partials.card')
        @include('partials.pagination')
    @endif

@endsection
