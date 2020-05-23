@extends('base')

@section('title', trans('common.stories_list'))

@section('content')
    <h1>{{ trans('stories.list_title') }}</h1>

    @include('stories.partials.story_card', ['stories' => $stories])
@endsection

@push('footer-scripts')
    @include('stories.js.list-js')
@endpush
