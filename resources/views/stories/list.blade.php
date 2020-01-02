@extends('base')

@section('title', trans('common.stories_list'))

@section('content')
    <h1>{{ trans('stories.list_title') }}</h1>

    <fieldset class="ml-2">
        <legend>{{ trans('common.filters') }}</legend>

        <div class="form-group row ml-2">
            {!! Form::label('languages', trans('common.language'), ['class' => 'control-label col-2']) !!}
            {!! Form::select('languages', $languages , null , ['class' => 'form-control col-4', 'id' => 'languages', 'style' => 'width: 15%']) !!}
        </div>

        <div class="form-group row ml-2">
            {!! Form::label('languages', trans('common.global_search'), ['class' => 'control-label col-2']) !!}
            <input class="form-control col-4" id="globalSearch" type="text" data-type="search" name="search">
        </div>
    </fieldset>

    <table id="stories-table" class="stripe">
        <thead>
            <tr>
                <th></th>   {{-- Child rows button --}}
                <th></th>   {{-- hidden stories IDs (used by Datatables & JS --}}
                <th>{{ __('admin.title') }}</th>
                <th>{{ __('common.genres') }}</th>
                <th>{{ __('common.language') }}</th>
                <th>{{ __('common.author') }}</th>
                <th>{{ __('common.created_at') }}</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th>{{ __('admin.title') }}</th>
            <th>{{ __('common.genres') }}</th>
            <th>{{ __('common.language') }}</th>
            <th>{{ __('common.author') }}</th>
            <th>{{ __('common.created_at') }}</th>
        </tr>
        </tfoot>
    </table>
@endsection

@push('footer-scripts')
    @include('stories.js.list-js')
@endpush
