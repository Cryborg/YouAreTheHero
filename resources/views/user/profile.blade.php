@extends('base')

@section('title', $title)

@section('content')
    <div class="row p-4">
        <div class="col-8">
            <h1>{{ trans('user.profile_title') }}</h1>
            <form action="{{ route('user.profile.post') }}">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">{{ trans('validation.attributes.first_name') }}</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="first_name"
                            placeholder="{{ trans('validation.attributes.first_name') }}" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">{{ trans('validation.attributes.last_name') }}</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="last_name"
                            placeholder="{{ trans('validation.attributes.last_name') }}" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">{{ trans('validation.attributes.email') }}</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email"
                            placeholder="{{ trans('validation.attributes.email') }}" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">{{ trans('validation.attributes.password') }}</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password"
                            placeholder="{{ trans('validation.attributes.password') }}" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">{{ trans('validation.attributes.password_confirmation') }}</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword2"
                            placeholder="{{ trans('validation.attributes.password_confirmation') }}" value="">
                    </div>
                </div>
{{--                <fieldset class="form-group">--}}
{{--                    <div class="row">--}}
{{--                        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>--}}
{{--                                <label class="form-check-label" for="gridRadios1">--}}
{{--                                    First radio--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">--}}
{{--                                <label class="form-check-label" for="gridRadios2">--}}
{{--                                    Second radio--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="form-check disabled">--}}
{{--                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>--}}
{{--                                <label class="form-check-label" for="gridRadios3">--}}
{{--                                    Third disabled radio--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </fieldset>--}}
{{--                <div class="form-group row">--}}
{{--                    <div class="col-sm-2">Checkbox</div>--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="checkbox" id="gridCheck1">--}}
{{--                            <label class="form-check-label" for="gridCheck1">--}}
{{--                                Example checkbox--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="form-group row">--}}
{{--                    <div class="col-sm-10">--}}
{{--                        <button type="submit" class="btn btn-primary">Sign in</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </form>
        </div>
    </div>
@endsection
