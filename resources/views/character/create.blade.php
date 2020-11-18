@extends('base')

@section('title', $title)

@section('content')
    <input type="hidden" value="{{ $story->id }}" id="storyId">

    <div class="row">
        <div class="col-md-12 col-xl-6">
            <h2 class="mb-5">{{ $story->title }}</h2>

            @if ($story->options && $story->options->has_character)
                <div class="form-group">
                    <div class="card">
                        <div class="card-header">
                            {!! Form::label('name', trans('character.name_label'), ['class' => 'control-label']) !!}
                        </div>
                        <div class="card-body">
                            <p class="help-block">{{ trans('character.name_help') }}</p>

                            <div class="col my-1">
                                @if ($story->options && in_array($story->options->character_genre, [\App\Classes\Constants::GENRE_MALE, \App\Classes\Constants::GENRE_FEMALE]))
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                @include('partials.description', [
                                                    'link_text' => '<span class="icon-' . $story->options->character_genre . ' font-biggest"></span>',
                                                    'content' => trans('character.genre_' . $story->options->character_genre . '_help'),
                                                    'icon' => false
                                                ])
                                            </div>
                                        </div>
                                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                                        <div class="alert alert-danger hidden">{{ trans('character.name_error') }}</div>
                                    </div>
                                @elseif ($story->options && $story->options->character_genre === \App\Classes\Constants::GENRE_BOTH)
                                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                                    <div class="alert alert-danger hidden">{{ trans('character.name_error') }}</div>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <label class="ml-4">
                                                {!! Form::radio('character_genre', 'male', true) !!}
                                                @lang('character.genre_male')
                                                <span class="text-muted font-smaller ml-3">
                                                    @lang('character.genre_male_help')
                                                </span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <label class="ml-4">
                                                {!! Form::radio('character_genre', 'female') !!}
                                                @lang('character.genre_female')
                                                <span class="text-muted font-smaller ml-3">
                                                    @lang('character.genre_female_help')
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($has_visible_fields && $story->options && $story->options->has_stats && $story->options->points_to_share > 0)
                <div class="card">
                    <div class="card-header">
                        {!! Form::label('stats', trans('character.stats_label'), ['class' => 'control-label']) !!}
                    </div>
                    <div class="card-body">
                        <p class="help-block">{{ trans('character.stats_help') }}</p>

                        <div class="row">
                            <div class="col-4 text-center">
                                @lang('field.points_left_to_share')
                                <div id="points_left" data-original-value="{{ $story->options->points_to_share }}">{{ $story->options->points_to_share }}</div>
                            </div>
                            <div class="col-8">
                                @foreach($story->fields as $field)
                                    @if ($field->hidden === false)
                                        <div class="form-group row">
                                            <div class="col-md-4 col-lg-4">
                                                {{ $field->name }}
                                                <small class="text-muted d-inline d-md-none">({{ trans('field.range_text', [
                                                        'min' => $field->min_value,
                                                        'max' => $field->max_value
                                                    ]) }})
                                                </small>
                                            </div>
                                            <div class="col-md-6 col-lg-3 quantity">
                                                <input name="stat_value" type="number" value="{{ old('stat_value') ?? $field->min_value }}"
                                                    min="{{ $field->min_value }}" max="{{ $field->max_value }}" step="1"
                                                    data-field_id="{{ $field->id }}" data-original-value="{{ old('stat_value') ?? $field->min_value }}"
                                                    class="input-number w-100"/>
                                            </div>
                                            <div class="col-2">
                                                <small class="text-muted d-none d-md-block">({{ trans('field.range_text', [
                                                        'min' => $field->min_value,
                                                        'max' => $field->max_value
                                                    ]) }})
                                                </small>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($story->people->count() > 0)
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                @lang('people.people')
                            </div>
                            <div class="card-body">
                                <p class="help-block">{{ trans('story.people_help') }}</p>

                                <table id="people_story" class="table mb-3 m-0">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('people.role') }}</th>
                                            <th>{{ trans('people.first_name') }}</th>
                                            <th>{{ trans('people.last_name') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($story->people as $person)
                                            <tr class="row_person" data-personid="{{ $person->id }}">
                                                <td>
                                                    <div>{{ $person->role }}</div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control first_name" value="{{ $person->first_name }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control last_name" value="{{ $person->last_name }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col">
                    <button id="save_character" class="btn btn-success submit-btn mb-1 w-100"
                        data-original-text="{{ trans('story.create_submit') }}"
                        @if ($has_visible_fields && $story->fields->count() > 0 && $story->options->points_to_share > 0) disabled @endif
                    >{{ trans('story.create_submit') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        @include('character.js.create-js')
    </script>
@endpush
