@extends('layout')

@section('title', 'Stories list')

@section('body')
    Here are all the stories I got:
    @foreach ($stories as $story)
        <ul>
            <li>{{ $story->title }}</li>
        </ul>
    @endforeach
@endsection
