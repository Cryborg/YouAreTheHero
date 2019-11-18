@extends('layout')

@section('title', 'Stories list')

@section('body')
    Here are all the stories I got:
    @foreach ($stories as $story)
        <fieldset>
            <legend>{{ $story->title }}</legend>
            <p><i>By {{ $story->user_id  }}</i></p>
            {{ $story->description }}
        </fieldset>
    @endforeach
@endsection
