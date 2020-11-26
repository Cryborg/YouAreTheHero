@extends('base')

@section('title', $title)

@section('content')
    <div class="row p-4">
        <div class="col-lg-6">
            <h1>{{ trans('user.profile_title') }}</h1>

            <div class="row mb-4">
                <div class="col text-center">
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" class="profile-picture profile-picture-lg border border-primary border-5">
                    @endif
                </div>
            </div>

            {!! Form::model(\App\Models\User::class, array('route' => array('user.profile.post', $user->id))) !!}
                <div class="form-group row">
                    {!! Form::label('first_name', trans('validation.attributes.first_name'), ['class' => 'col-sm-3 col-form-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('first_name', old('first_name', $user->first_name), ['class' => 'form-control']) !!}
                        {!! $errors->first('first_name', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('last_name', trans('validation.attributes.last_name'), ['class' => 'col-sm-3 col-form-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('last_name', old('email', $user->last_name), ['class' => 'form-control']) !!}
                        {!! $errors->first('last_name', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('username', trans('validation.attributes.username'), ['class' => 'col-sm-3 col-form-label required']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('username', old('email', $user->username), ['class' => 'form-control', 'required' => true]) !!}
                        {!! $errors->first('username', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('email', trans('validation.attributes.email'), ['class' => 'col-sm-3 col-form-label required']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('email', old('email', $user->email), ['class' => 'form-control', 'required' => true]) !!}
                        {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
                    </div>
                </div>

                <a class="nav-link" href="{{ route('password.request') }}">
                    {{ trans('auth.forgot_password') }}
                </a>

                <div class="form-group mt-5">
                    <label class="row">
                        <span class="col form-check">
                            {!! Form::checkbox('optin_system', 1, old('optin_system', $user->optin_system) ?? 0,  ['id' => 'optin_system', 'class' => 'form-check-input']) !!}
                            <span class="form-check-label" for="optin_system">
                                @lang('user.options.optin_system')
                            </span>
                        </span>
                    </label>
                    <label class="row">
                        <span class="col form-check">
                            {!! Form::checkbox('show_help', 1, old('show_help', $user->show_help) ?? 0,  ['id' => 'show_help', 'class' => 'form-check-input']) !!}
                            <span class="form-check-label" for="show_help">
                                @lang('user.options.show_help')
                            </span>
                        </span>
                    </label>
                </div>

                {!! Form::submit(trans('common.save'), ['class' => 'form-control btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>
        <div class="col-lg-6">
            <h1 class="mb-3">Mes succès</h1>
            <div class="form-group row">
                @foreach ($authUser->successes as $success)
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="img/trophy.svg" height="50" title="{{ trans('success.' . $success->title . '_description') }}">
                        </div>
                        <div class="card-footer">
                            {{ trans('success.' . $success->title) }}<br>
                            <small class="moment_date">{{ $success->pivot->created_at }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        showHumanReadableDates();
    </script>
@endpush
