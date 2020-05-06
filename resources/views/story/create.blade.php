@extends('base')

@section('title', $title)

@section('content')
    <h1>{{ $story ? trans('story.edit_title') : trans('story.create_title') }}</h1>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ trans('story.create_tab1') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (!$story instanceof \App\Models\Story) disabled @endif" id="pills-options-tab" data-toggle="pill" href="#pills-options" role="tab"
                aria-controls="pills-options" aria-selected="false">{{ trans('story.create_tab2') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (!$story instanceof \App\Models\Story) disabled @endif" id="pills-sheet-tab" data-toggle="pill" href="#pills-sheet" role="tab"
                aria-controls="pills-sheet" aria-selected="false">{{ trans('story.create_tab3') }}</a>
        </li>
        @if ($story && $story->getCurrentPage())
            <li class="nav-item">
                <button class="btn btn-success h-100 font-default-size" onclick="window.location.href='{{ route('page.edit', ['page' => $story->getCurrentPage()->uuid]) }}'">
                    {{ trans('story.resume_editing') }}
                </button>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            {!! Form::model(\App\Models\Story::class, array('route' => array($route, $story ? $story->id : null))) !!}
            {{ Form::hidden('story_id', $story->id ?? null) }}
            <div class="form-group">
                {!! Form::label('title', trans('model.title'), ['class' => 'control-label']) !!}
                <p class="help-block">{{ trans('model.story_title_help') }}</p>
                {!! Form::text('title', $story ? $story->title : old('title'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', trans('model.description'), ['class' => 'control-label']) !!}
                <p class="help-block">{{ trans('model.description_help') }}</p>
                {!! Form::textarea('description', $story ? $story->description : old('description'), ['class' => 'form-control', 'rows' => 5]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('locale', trans('model.locale'), ['class' => 'control-label']) !!}
                {!! Form::select('locale', $locales , $story ? $story->locale : old('locale') , ['class' => 'form-control']) !!}
            </div>

            <div class="form-group hidden">
                {!! Form::label('layout', trans('model.layout'), ['class' => 'control-label']) !!}
                {!! Form::select('layout', $layouts , $story ? $story->layout : old('layout') , ['class' => 'form-control']) !!}
            </div>

            @if (Route::current()->getName() === 'story.edit')
                <div class="form-group form-check">
                    <label>
                        {!! Form::checkbox('is_published', 1, $story ? $story->is_published : old('is_published') ?? 0, ['id' => 'is_published']) !!}
                        @lang('model.is_published')
                    </label>
                </div>
            @endif

            <div class="row">
                <div class="form-group col-xs-12 col-lg-3">
                    {!! Form::label('genres', trans('story.genres_label')) !!}
                    <p class="help-block">{!! trans('story.genres_help') !!}</p>
                    <select class="selectpicker" title="{{ trans('story.select_genres_placeholder') }}"
                        size="6" id="genres" name="genres[]" multiple required
                        data-live-search="true" data-max-options="5">
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}"
                                @foreach ($story->genres ?? [] as $storyGenre)
                                @if ($storyGenre->id == $genre->id) selected @endif
                                @endforeach
                            >{{ $genre->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {!! Form::submit(trans('story.create_submit'), ['class' => 'form-control btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>

        <div class="tab-pane" id="pills-options" role="tabpanel" aria-labelledby="pills-options-tab">
            <label>{{ trans('character.character_label') }}</label>
            <p class="help-block">{!! trans('story.has_character_help') !!}</p>

            <div class="form-group form-check ml-3">
                <input class="form-check-input" type="checkbox" value="1" id="has_character" name="has_character"
                    @if ($story && $story->story_options && $story->story_options->has_character) checked @endif
                >
                <label class="form-check-label" for="has_character">
                    {{ trans('story.has_character_label') }}
                </label>
            </div>

            <label>{{ trans('stat.sheet') }}</label>
            <p class="help-block">{!! trans('story.has_stats_help') !!}</p>

            <div class="form-group form-check ml-3">
                <input class="form-check-input" type="checkbox" value="1" id="has_stats" name="has_stats"
                    @if ($story && $story->story_options && $story->story_options->has_stats) checked @endif
                >
                <label class="form-check-label" for="has_stats">
                    {{ trans('story.has_stats_label') }}
                </label>
            </div>

{{--            EN ATTENTE DES LANCERS DE DéS            --}}
{{--            <label>{{ trans('stat.attribution_label') }}</label>--}}
{{--            <p class="help-block">{!! trans('story.stat_attribution_help') !!}</p>--}}

{{--            <div class="form-check ml-3">--}}
{{--                <input class="form-check-input" type="radio" name="stat_attribution" id="stat_attribution_player" value="player"--}}
{{--                    @if ($story->story_options->stat_attribution === 'player') checked @endif--}}
{{--                >--}}
{{--                <label class="form-check-label" for="stat_attribution_player">--}}
{{--                    {{ trans('story.stat_attribution_player') }}--}}
{{--                </label>--}}
{{--            </div>--}}
{{--            <div class="form-check ml-3">--}}
{{--                <input class="form-check-input" type="radio" name="stat_attribution" id="stat_attribution_dice" value="dice"--}}
{{--                    @if ($story->story_options->stat_attribution === 'dice') checked @endif--}}
{{--                >--}}
{{--                <label class="form-check-label" for="stat_attribution_dice">--}}
{{--                    {{ trans('story.stat_attribution_dice') }}--}}
{{--                </label>--}}
{{--            </div>--}}
        </div>
        <div class="tab-pane" id="pills-sheet" role="tabpanel" aria-labelledby="pills-tab-3">
            {!! Form::label('stat_story', trans('story.stats_label')) !!}
            <p class="help-block">{!! trans('story.genres_help') !!}</p>
            <table id="stats_story" class="mb-3 w-50 m-0">
                <thead>
                    <tr>
                        <th>{{ trans('stat.full_name') }}</th>
                        <th>{{ trans('stat.short_name') }}</th>
                        <th>{{ trans('stat.min_value') }}</th>
                        <th>{{ trans('stat.max_value') }}</th>
                        <th>{{ trans('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($story->stat_stories ?? [] as $stat)
                        <tr>
                            <td>{{ $stat->full_name }}</td>
                            <td>{{ $stat->short_name }}</td>
                            <td>{{ $stat->min_value }}</td>
                            <td>{{ $stat->max_value }}</td>
                            <td class="text-center">
                                <span class="glyphicon glyphicon-trash-red" data-statstory_id="{{ $stat->id }}"></span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><input class="new_stat form-control" type="text" id="full_name" maxlength="15" autocomplete="nope" required></th>
                        <th><input class="new_stat form-control" type="text" id="short_name" maxlength="5" autocomplete="nope" required></th>
                        <th><input class="new_stat form-control" type="number" id="min_value" value="1" required></th>
                        <th><input class="new_stat form-control" type="number" id="max_value" value="10" required></th>
                        <th class="text-center">
                            <span class="glyphicon glyphicon-plus-sign"></span>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('footer-scripts')
    @if ($story)
        @include('story.js.create-js')
    @endif
@endpush
