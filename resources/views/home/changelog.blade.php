@extends('base')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('common.changelog') }}</div>
                    <fieldset>
                        <legend>April, xxxxxxxth 2020</legend>
                        <ul>
                            <li>Improvements:</li>
                            <ul>
                                <li>Storytellers can now include <b>basic riddles</b> in their pages! It allows the creation of <b>escape books</b>!</li>
                            </ul>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <legend>April, 8th 2020</legend>
                        <ul>
                            <li>Fixes:</li>
                            <ul>
                                <li>Bypass character creation when there is no need for it</li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Improvements:</li>
                            <ul>
                                <li>Show roles in admin pages (with <a target="_blank" href="https://getbootstrap.com/docs/4.4/components/badge/">Bootstrap badges</a>)</li>
                                <li>Added some info in admin pages</li>
                            </ul>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <legend>January, 30th 2020</legend>
                        <ul>
                            <li>Fixes:</li>
                            <ul>
                                <li>A few translations</li>
                                <li>Newly added stats couldn't be deleted without a page refresh</li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Improvements:</li>
                            <ul>
                                <li>Admin pages (basic statistics only)</li>
                                <li>Basic story options</li>
                                <li>Added a few <a target="_blank" href="https://getbootstrap.com/docs/3.3/components/">Glyphicons</a> here and there</li>
                            </ul>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <legend>January, 21st 2020</legend>
                        <ul>
                            <li>Fixes:</li>
                            <ul>
                                <li>A few wordings have been changed for clarification</li>
                                <li>"Add stat" button on story creation page was not enabled in some cases</li>
                                <li>Disabled autocomplete on some fields</li>
                                <li>Publishing a story wasn't working</li>
                            </ul>
                        </ul>
                        <ul>
                            <li>Improvements:</li>
                            <ul>
                                <li>Effects can now be added to items</li>
                            </ul>
                        </ul>
                    </fieldset>
                </div>

                <div class="card-footer text-right">
                    <small class="text-muted">
                        {{ trans('common.current_version', ['version' => '0.1']) }}
                    (<a href="{{ url('changelog') }}">{{ trans('common.changelog') }}</a>)
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
