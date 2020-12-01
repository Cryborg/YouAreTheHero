@extends('base')

@section('title', $title)

@section('content')
    <h1>{{ $story ? trans('story.edit_title') : trans('story.create_title') }}</h1>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ trans('story.create_tab1') }}</a>
        </li>
        @if ($story)
            <li class="nav-item">
                <a class="nav-link" id="pills-options-tab" data-toggle="pill" href="#pills-options" role="tab" aria-controls="pills-options" aria-selected="false">{{ trans('story.create_tab2') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-sheet-tab" data-toggle="pill" href="#pills-sheet" role="tab" aria-controls="pills-sheet" aria-selected="false">{{ trans('story.create_tab3') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-equipment-tab" data-toggle="pill" href="#pills-equipment" role="tab" aria-controls="pills-equipment" aria-selected="false">{{ trans('story.create_tab5') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-items-tab" data-toggle="pill" href="#pills-items" role="tab" aria-controls="pills-items" aria-selected="false">{{ trans('story.create_tab4') }}</a>
            </li>
        @endif
        @if ($story && $story->getCurrentPage())
            <li class="nav-item">
                <button class="btn btn-success h-100 font-default-size ml-3" onclick="window.location.href='{{ route('page.edit', ['page' => $story->getCurrentPage()->id]) }}'">
                    {{ trans('story.resume_editing') }}
                </button>
            </li>
        @endif
    </ul>

    <div class="tab-content" id="pills-tabContent">

        {{-- Story creation --}}
        <div class="tab-pane active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            {!! Form::model(\App\Models\Story::class, array('route' => array($route, $story ?? null))) !!}
            {{ Form::hidden('story_id', $story->id ?? null) }}
            <div class="card">
                <div class="card-header">
                    @lang('model.title')
                </div>
                <div class="card-body">
                    <x-help-block :help="trans('model.story_title_help')"></x-help-block>
                    {!! Form::text('title', $story ? $story->title : old('title'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    @lang('model.description')
                </div>
                <div class="card-body">
                    <x-help-block :help="trans('model.description_help')"></x-help-block>
                    {!! Form::textarea('description', $story ? $story->description : old('description'), ['class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    @lang('model.locale')
                </div>
                <div class="card-body">
                    {!! Form::label('locale', trans('model.locale'), ['class' => 'control-label']) !!}
                    {!! Form::select('locale', $locales , $story ? $story->locale : old('locale') , ['class' => 'form-control']) !!}
                </div>
                @if (Route::current()->getName() === 'story.edit')
                    <div class="card-footer">
                        <label>
                            {!! Form::checkbox('is_published', 1, $story ? $story->is_published : old('is_published') ?? 0, ['id' => 'is_published']) !!}
                            @lang('model.is_published')
                        </label>
                    </div>
                @endif
            </div>
            <div class="form-group hidden">
                {!! Form::label('layout', trans('model.layout'), ['class' => 'control-label']) !!}
                {!! Form::select('layout', $layouts , $story ? $story->layout : old('layout') , ['class' => 'form-control']) !!}
            </div>
            <div class="card">
                <div class="card-header">
                    @lang('story.genres_label')
                </div>
                <div class="card-body">
                    <x-help-block :help="trans('story.genres_help')"></x-help-block>
                    <select class="selectpicker" title="{{ trans('story.select_genres_placeholder') }}" data-size="6" id="genres" name="genres[]" multiple required data-live-search="true" data-max-options="5">
                        <optgroup label="{{ trans('common.audience') }}">
                            @foreach($audiences as $audience)
                                <option value="{{ $audience->id }}" @foreach ($story->genres ?? [] as $storyGenre)@if ($storyGenre->id == $audience->id) selected @endif
                                    @endforeach
                                >{{ $audience->label }}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="{{ trans('common.genres') }}">
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" @foreach ($story->genres ?? [] as $storyGenre)@if ($storyGenre->id == $genre->id) selected @endif
                                    @endforeach
                                >{{ $genre->label }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="card-footer">
                    <p class="text-muted">@lang('')</p>
                </div>
            </div>
            {!! Form::submit(trans('story.create_submit'), ['class' => 'form-control btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>

        {{-- Story options --}}
        <div class="tab-pane" id="pills-options" role="tabpanel" aria-labelledby="pills-options-tab">
            @include('story.partials.create.options', ['story' => $story])
        </div>

        {{-- Character sheet --}}
        <div class="tab-pane" id="pills-sheet" role="tabpanel" aria-labelledby="pills-tab-3">
            @include('story.partials.create.sheet', ['story' => $story])
        </div>

        {{-- Equipment--}}
        <div class="tab-pane" id="pills-equipment" role="tabpanel" aria-labelledby="pills-tab-5">
            @include('story.partials.create.equipment', ['story' => $story])
        </div>

        {{-- Items --}}
        @isset($story)
            <div class="tab-pane" id="pills-items" role="tabpanel" aria-labelledby="pills-tab-4">
                @include('story.partials.create.items', ['story' => $story])
            </div>
        @endisset
    </div>
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        @if ($story)
            let storyId = {{ $story->id }};
            @include('story.js.create-js')

            const routeItem = '{{ route('item.store') }}';
            @include('item.js.create_item_js', ['story' => $story, 'contexts' => $contexts])
        @endif
    </script>
@endpush
