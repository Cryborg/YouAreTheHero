@extends('layouts.layout')

@section('title', 'Stories list')

@section('content')
    Here are all the stories I got:
    @foreach ($stories as $story)
        <fieldset>
            <legend>{{ $story->title }}</legend>
            <p><i>By {{ $story->getUser()->first_name }} {{ $story->getUser()->last_name  }}</i></p>
            <p>{{ $story->description }}</p>
            <p><a href="{{ url('story/' . $story->id) }}">Let's play!</a></p>
        </fieldset>
    @endforeach
@endsection
