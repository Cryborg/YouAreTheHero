<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                @lang('story.stats_label')
            </div>

            <div class="card-body">
                <x-help-block :help="trans('story.has_character_help')"></x-help-block>
                <div class="form-group form-check ml-3">
                    <input class="form-check-input" type="checkbox" value="1" id="has_character" name="has_character" @if ($story && $story->options && $story->options->has_character) checked @endif
                    > <label class="form-check-label" for="has_character">
                        {{ trans('story.has_character_label') }}
                    </label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="character_genre"
                            value="male" id="genre_male" @if ($story && $story->options && $story->options->character_genre === \App\Classes\Constants::GENRE_MALE) checked @endif>
                        <label for="genre_male" class="form-check-label">@lang('character.genre_male')</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="character_genre"
                            value="female" id="genre_female" @if ($story && $story->options && $story->options->character_genre === \App\Classes\Constants::GENRE_FEMALE) checked @endif>
                        <label for="genre_female" class="form-check-label">@lang('character.genre_female')</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="character_genre"
                            value="both" id="genres_both" @if ($story && $story->options && $story->options->character_genre === \App\Classes\Constants::GENRE_BOTH) checked @endif>
                        <label for="genres_both" class="form-check-label">@lang('story.genres_both')</label>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    @lang('field.sheet')
                </div>
                <div class="card-body">
                    <x-help-block :help="trans('story.has_stats_help')"></x-help-block>

                    <div class="form-group form-check ml-3">
                        <input class="form-check-input" type="checkbox" value="1" id="has_stats" name="has_stats" @if ($story && $story->options && $story->options->has_stats) checked @endif>
                        <label class="form-check-label" for="has_stats">
                            {{ trans('story.has_stats_label') }}
                        </label>
                    </div>
                </div>
            </div>

            @if ($story)
                <div class="card-body hasStats">
                    <x-help-block :help="trans('story.stats_help')"></x-help-block>

                    <div class="form-group row ml-3">
                        <label for="points_to_share">@lang('story.points_to_share')</label>
                        <input type="number" class="form-control" value="@if ($story && $story->options){{ $story->options->points_to_share }}@else 10 @endif" min="0" id="points_to_share" limit-to-max>
                    </div>

                    <table id="stats_story" class="table mb-3 m-0">
                        <thead>
                            <tr>
                                <th>{{ trans('field.name') }}</th>
                                <th>{{ trans('field.min_value') }}</th>
                                <th>{{ trans('field.max_value') }}</th>
                                <th>{{ trans('field.start_value') }}</th>
                                <th class="text-center">{{ trans('field.hidden_to_players') }}</th>
                                <th class="text-center">{{ trans('common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('story.partials.body_fields', $story)
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                    <input class="new_field form-control" type="text" id="name" maxlength="15" autocomplete="nope" required>
                                </th>
                                <th>
                                    <input class="new_field form-control" type="number" id="min_value" value="1" required>
                                </th>
                                <th>
                                    <input class="new_field form-control" type="number" id="max_value" value="10" required>
                                </th>
                                <th>
                                    <input class="new_field form-control" type="number" id="start_value" value="1" required>
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
            @endif
        </div>
    </div>
    @if ($story)
        <div class="col">
            <div class="card">
                <div class="card-header">@lang('people.people')</div>
                <div class="card-body">
                    <x-help-block :help="trans('people.help')"></x-help-block>

                    <table id="people_story" class="table mb-3 m-0">
                        <thead>
                            <tr>
                                <th>{{ trans('people.first_name') }}</th>
                                <th>{{ trans('people.last_name') }}</th>
                                <th>{{ trans('people.role') }}</th>
                                <th class="text-center">{{ trans('common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($story->people as $person)
                                <tr>
                                    <td>
                                        <div>{{ $person->first_name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $person->last_name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $person->role }}</div>
                                    </td>
                                    <td class="text-center">
                                        <span class="icon-trash text-red clickable deletePerson" data-person_id="{{ $person->id }}"></span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" id="first_name">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="last_name">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="role">
                                </td>
                                <td class="text-center">
                                    <span class="btn btn-primary addPerson">Add</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
