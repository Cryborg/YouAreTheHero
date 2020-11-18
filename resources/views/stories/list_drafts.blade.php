@extends('base')

@section('title', trans('stories.drafts_list_title'))

@section('content')
    <h1>{{ trans('stories.drafts_list_title') }}</h1>

    <table class="table" id="stories-table">
        <thead>
            <tr>
                <th>@lang('common.id')</th>
                <th>@lang('common.actions')</th>
                <th>@lang('story.title')</th>
                <th>@lang('story.number_pages') (@lang('page.report.count')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stories as $story)
                <tr>
                    <td>{{ $story->id }}</td>
                    <td>
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group mr-2" role="group">
                                <a class="btn btn-light" href="{{ route('page.edit', ['page' => $story->pages->last()->id]) }}">
                                    <span class="icon-fountain-pen"></span>
                                </a>
                                <a class="btn btn-light" href="{{ route('story.edit', ['story' => $story->id]) }}">
                                    <span class="icon-settings"></span>
                                </a>
                            </div>
                            @if ($story->is_published === false)
                                <div class="btn-group" role="group">
                                    <a class="btn border-danger border-2">
                                        <span class="icon-trash text-red deleteStory" data-storyid="{{ $story->id }}"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="w-50">{{ $story->title }}</td>
                    <td>{{ $story->pages()->count() }}
                        @if ($story->reports()->count() > 0)
                            (<a href="{{ route('reports.list', ['story' => $story]) }}">{{ $story->reports()->count() }}</a>)
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>@lang('common.id')</th>
            <th>@lang('common.actions')</th>
            <th>@lang('story.title')</th>
            <th>@lang('story.number_pages')</th>
        </tr>
        </tfoot>
    </table>
@endsection

@push('footer-scripts')
    @include('stories.js.list-js')
@endpush
