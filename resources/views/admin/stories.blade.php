@extends('base')

@section('title', $title)

@section('content')
    <div class="row m-5">
        <div class="col-lg-2">
            @include('admin.partials.nav', ['active' => 3])
        </div>
        <div class="col-lg-10">
            <h1>{{ trans('admin.users_title') }}</h1>
            <table class="dataTable">
                <thead>
                    <th>{{ trans('story.id') }}</th>
                    <th>{{ trans('story.title') }}</th>
                    <th>{{ trans('story.author') }}</th>
                    <th>{{ trans('story.number_pages') }}</th>
                </thead>
                <tbody>
                    @foreach ($stories as $story)
                        <tr>
                            <td>{{ $story->id }}</td>
                            <td>{{ $story->title }}</td>
                            <td>{{ $story->author->username }}</td>
                            <td>{{ $story->pages->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
