@extends('base')

@section('title', $title)

@section('content')
    @foreach ($persons as $person)
        {{ $person->first_name }}
    @endforeach

    @dump($data)
@endsection
