@extends('base')

@section('title', $title)

@section('content')
    <div class="row p-4">
        <div class="col-lg-6">
            <h1>{{ trans('user.profile_title') }}</h1>

            <div class="row mb-4">
                <div class="col text-center">
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" class="profile-picture border border-primary border-5">
                    @endif
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('first_name', trans('validation.attributes.first_name'), ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('first_name', old('first_name', $user->first_name), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    {!! $errors->first('first_name', '<p class="help-block text-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('last_name', trans('validation.attributes.last_name'), ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('last_name', old('email', $user->last_name), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    {!! $errors->first('last_name', '<p class="help-block text-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('username', trans('validation.attributes.username'), ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('username', old('email', $user->username), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    {!! $errors->first('username', '<p class="help-block text-danger">:message</p>') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
