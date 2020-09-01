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
                <a class="nav-link @if ($story->story_options && !$story->story_options->has_stats) hidden @endif" id="pills-sheet-tab" data-toggle="pill" href="#pills-sheet" role="tab" aria-controls="pills-sheet" aria-selected="false">{{ trans('story.create_tab3') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-items-tab" data-toggle="pill" href="#pills-items" role="tab" aria-controls="pills-sheet" aria-selected="false">{{ trans('story.create_tab4') }}</a>
            </li>
        @endif
        @if ($story && $story->getCurrentPage())
            <li class="nav-item">
                <button class="btn btn-success h-100 font-default-size" onclick="window.location.href='{{ route('page.edit', ['page' => $story->getCurrentPage()->id]) }}'">
                    {{ trans('story.resume_editing') }}
                </button>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            {!! Form::model(\App\Models\Story::class, array('route' => array($route, $story ? $story->id : null))) !!}
            {{ Form::hidden('story_id', $story->id ?? null) }}
            <div class="card">
                <div class="card-header">
                    @lang('model.title')
                </div>
                <div class="card-body">
                    <p class="help-block">@lang('model.story_title_help')</p>
                    {!! Form::text('title', $story ? $story->title : old('title'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    @lang('model.description')
                </div>
                <div class="card-body">
                    <p class="help-block">@lang('model.description_help')</p>
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
                    <p class="help-block">@lang('story.genres_help')</p>
                    <select class="selectpicker" title="{{ trans('story.select_genres_placeholder') }}" data-size="6" id="genres" name="genres[]" multiple required data-live-search="true" data-max-options="5">
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" @foreach ($story->genres ?? [] as $storyGenre)@if ($storyGenre->id == $genre->id) selected @endif
                                @endforeach
                            >{{ $genre->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="card-footer">
                    <p class="text-muted">@lang('')</p>
                </div>
            </div>
            {!! Form::submit(trans('story.create_submit'), ['class' => 'form-control btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <div class="tab-pane" id="pills-options" role="tabpanel" aria-labelledby="pills-options-tab">
            <div class="card">
                <div class="card-header">
                    @lang('character.character_label')
                </div>
                <div class="card-body">
                    <p class="help-block">@lang('story.has_character_help')</p>
                    <div class="form-group form-check ml-3">
                        <input class="form-check-input" type="checkbox" value="1" id="has_character" name="has_character" @if ($story && $story->story_options && $story->story_options->has_character) checked @endif
                        > <label class="form-check-label" for="has_character">
                            {{ trans('story.has_character_label') }}
                        </label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="character_genre"
                                value="male" id="genre_male" @if ($story && $story->story_options && $story->story_options->character_genre === \App\Classes\Constants::GENRE_MALE) checked @endif>
                            <label for="genre_male" class="form-check-label">@lang('user.genre_male')</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="character_genre"
                                value="female" id="genre_female" @if ($story && $story->story_options && $story->story_options->character_genre === \App\Classes\Constants::GENRE_FEMALE) checked @endif>
                            <label for="genre_female" class="form-check-label">@lang('user.genre_female')</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="character_genre"
                                value="both" id="genre_both" @if ($story && $story->story_options && $story->story_options->character_genre === \App\Classes\Constants::GENRE_BOTH) checked @endif>
                            <label for="genre_both" class="form-check-label">@lang('user.genre_both')</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    @lang('field.sheet')
                </div>
                <div class="card-body">
                    <p class="help-block">@lang('story.has_stats_help')</p>
                    <div class="form-group form-check ml-3">
                        <input class="form-check-input" type="checkbox" value="1" id="has_stats" name="has_stats" @if ($story && $story->story_options && $story->story_options->has_stats) checked @endif
                        > <label class="form-check-label" for="has_stats">
                            {{ trans('story.has_stats_label') }}
                        </label>
                    </div>
                </div>
            </div>
            @if ($story)
                <div class="card">
                    <div class="card-header">
                        @lang('story.inventory_slots')
                    </div>
                    <div class="card-body">
                        <p class="help-block">@lang('story.inventory_slots_help')</p>
                        {!! Form::number('inventory_slots', $story->story_options ? $story->story_options->inventory_slots : -1, ['class' => 'form-control', 'min' => 0, 'id' => 'inventory_slots']) !!}
                    </div>
                </div>
            @endif
        </div>
        <div class="tab-pane" id="pills-sheet" role="tabpanel" aria-labelledby="pills-tab-3">
            <div class="card">
                <div class="card-header">
                    @lang('story.stats_label')
                </div>
                <div class="card-body">
                    <p class="help-block">@lang('story.stats_help')</p>
                    <table id="stats_story" class="table mb-3 w-50 m-0">
                        <thead>
                            <tr>
                                <th>{{ trans('field.name') }}</th>
                                <th>{{ trans('field.short_name') }}</th>
                                <th>{{ trans('field.min_value') }}</th>
                                <th>{{ trans('field.max_value') }}</th>
                                <th class="text-center">{{ trans('field.hidden_to_players') }}</th>
                                <th class="text-center">{{ trans('common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($story->fields ?? [] as $stat)
                                <tr>
                                    <td>{{ $stat->name }}</td>
                                    <td>{{ $stat->short_name }}</td>
                                    <td>{{ $stat->min_value }}</td>
                                    <td>{{ $stat->max_value }}</td>
                                    <td class="text-center">
                                        <input type="checkbox" @if ($stat->hidden) checked @endif disabled></td>
                                    <td class="text-center">
                                        <span class="icon-trash text-danger deleteCharacterField" data-field_id="{{ $stat->id }}"></span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                    <input class="new_field form-control" type="text" id="name" maxlength="15" autocomplete="nope" required>
                                </th>
                                <th>
                                    <input class="new_field form-control" type="text" id="short_name" maxlength="5" autocomplete="nope" required>
                                </th>
                                <th>
                                    <input class="new_field form-control" type="number" id="min_value" value="1" required>
                                </th>
                                <th>
                                    <input class="new_field form-control" type="number" id="max_value" value="10" required>
                                </th>
                                <th class="text-center pl-4">
                                    <input class="new_field" type="checkbox" id="hidden_field" value="1"></th>
                                <th class="text-center">
                                    <span class="btn btn-primary addField">Add</span>
                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @isset($story)
            <div class="tab-pane" id="pills-items" role="tabpanel" aria-labelledby="pills-tab-4">
                <div class="row">
                    <div class="col">
                        @include('item.partials.new_item', ['story' => $story, 'context' => 'story_creation'])
                    </div>
                    <div class="col">
                        <div class="card">
                            <h5 class="card-header">
                                @lang('story.existing_items')
                            </h5>
                            <div class="card-body">
                                <div class="card-text itemListDiv">
                                    @include('page.js.partials.item_list_div', ['items' => $story->items])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection

@push('footer-scripts')
    @if ($story)
        <script type="text/javascript">
            var storyId = {{ $story->id }};
            @include('story.js.create-js')

            var routeItem = '{{ route('item.store') }}';
            @include('item.js.create_item_js', ['story' => $story, 'contexts' => $contexts])
        </script>
    @endif
@endpush
