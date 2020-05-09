@extends('base')

@section('title', trans('admin.title') . ' - ' . $title)

@section('content')
    <div class="row m-5">
        <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
            <h1 class="text-center">&nbsp;</h1>
            @include('admin.partials.nav', ['active' => 3])
        </div>
        <div class="col-md-8 col-lg-9 col-xl-10">
            <h1>{{ trans('admin.stories_title') }}</h1>
            <table class="dataTable">
                <thead>
                    <th>{{ trans('common.id') }}</th>
                    <th>{{ trans('story.title') }}</th>
                    <th>{{ trans('story.author') }}</th>
                    <th>{{ trans('story.number_pages') }}</th>
                    <th>{{ trans('story.last_update') }}</th>
                </thead>
                <tbody>
                    @foreach ($stories as $story)
                        <tr>
                            <td>{{ $story->id }}</td>
                            <td>{{ $story->title }}</td>
                            <td>{{ $story->author->username }}</td>
                            <td>{{ $story->pages->count() }}</td>
                            <td>{{ optional(optional($story->pages->sortByDesc('updated_at')->first())->updated_at)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
