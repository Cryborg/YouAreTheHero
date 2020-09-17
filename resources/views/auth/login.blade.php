@extends('base')

@section('title', trans('home.home_title'))

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                    @lang('common.quick_overview')
                </div>
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col text-justify pr-4">{!! trans('home.text')  !!}</div>
                        <div class="col-6">
                            <img src="{{ asset('img/screenshots/creation_interface.png') }}" class="w-100 shadow">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ trans('home.login_title') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('model.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ trans('model.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label ml-3" for="remember">
                                        {{ trans('auth.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('auth.login') }}
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                                    <div class="col-6 text-right">
                                        <a class="nav-link" href="{{ route('register') }}">
                                            {{ trans('home.register_title') }}
                                        </a>
                                    </div>
                                    <div class="col-6 text-left">
                                        <a class="nav-link" href="{{ route('password.request') }}">
                                            {{ trans('auth.forgot_password') }}
                                        </a>
                                    </div>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="card-body text-center">
                    <a href="{{ route('google.auth') }}">
                        <img src="{{ asset('img/btn_google_signin_dark_normal_web.png') }}">
                    </a>
                </div>

                <div class="card-footer text-center text-muted">
                    {!! trans('auth.users_count', ['count' => \App\Models\User::whereNotIn('role', ['temp'])->count()]) !!}
                </div>
            </div>
        </div>
        <div class="col">
            @include('stories.partials.story_card', ['story' => $tutoStory, 'anonymous' => true])
        </div>
    </div>
</div>
@endsection
