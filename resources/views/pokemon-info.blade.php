@extends('layouts.container')

@section('content')

    @includeWhen(isset($message), 'partials.message')
    @includeWhen(isset($pokemon), 'partials.card-pokemon-info')

@endsection
