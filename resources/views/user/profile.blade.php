@extends('base')

@section('title', $title)

@section('content')
    <div class="row p-4">
        <div class="col-5">
            <h1>{{ trans('user.profile_title') }}</h1>
            {!! Form::model(\App\Models\User::class, array('route' => array('user.profile.post', $user->id))) !!}
                <div class="form-group row">
                    {!! Form::label('first_name', trans('validation.attributes.first_name'), ['class' => 'col-sm-3 col-form-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('first_name', old('first_name', $user->first_name), ['class' => 'form-control']) !!}
                        {!! $errors->first('first_name', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('last_name', trans('validation.attributes.last_name'), ['class' => 'col-sm-3 col-form-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('last_name', old('email', $user->last_name), ['class' => 'form-control']) !!}
                        {!! $errors->first('last_name', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('username', trans('validation.attributes.username'), ['class' => 'col-sm-3 col-form-label required']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('username', old('email', $user->username), ['class' => 'form-control', 'required' => true]) !!}
                        {!! $errors->first('username', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('email', trans('validation.attributes.email'), ['class' => 'col-sm-3 col-form-label required']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('email', old('email', $user->email), ['class' => 'form-control', 'required' => true]) !!}
                        {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                </div>

                <a class="nav-link" href="{{ route('password.request') }}">
                    {{ trans('auth.forgot_password') }}
                </a>

                {!! Form::submit(trans('common.save'), ['class' => 'form-control btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
