<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                @lang('story.stats_label')
            </div>
            <div class="form-group ml-3">
                <label>@lang('story.points_to_share')</label>
                <input type="number" value="@if ($story && $story->options){{ $story->options->points_to_share }}@else 10 @endif" min="0" id="points_to_share" limit-to-max>
            </div>

            @if ($story)
                <div class="card-body">
                    <x-help-block :help="trans('story.stats_help')"></x-help-block>
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
