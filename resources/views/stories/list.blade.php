@extends('layout')

@section('title', 'Stories list')

@section('body')
    Here are all the stories I got:
    @foreach ($stories as $story)
        <fieldset>
            <legend>{{ $story->title }}</legend>
            <p><i>By {{ $story->getUser()->first_name }} {{ $story->getUser()->last_name  }}</i></p>
            {{ $story->description }}
        </fieldset>
    @endforeach
@endsection
