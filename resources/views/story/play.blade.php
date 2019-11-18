@extends('layout')

@section('title', $title)

@section('content')
    <h1>{{ $paragraph->title }}</h1>

    <p>{!! $paragraph->description !!}</p>

    <fieldset>
        <legend>Choices:</legend>
        <ul>
            @foreach ($paragraph->choices as $choice)
                <li><a href="{{ url('story/' . $story->id . '/' . $choice->paragraph_to) }}">{!! $choice->link_text !!}</a></li>
            @endforeach
        </ul>
    </fieldset>
@endsection
