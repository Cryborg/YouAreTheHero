@extends('base')@section('title', trans('home.home_title'))

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
                            <div class="col-lg-6 col-sm-12">
                                <div class="splide w-100 shadow">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            <li class="splide__slide">
                                                <div class="splide__slide__container">
                                                    <img src="{{ asset('img/screenshots/creation_interface.webp') }}"
                                                        class="w-100 preview" data-toggle="modal" data-target="#modalImage">
                                                </div>
                                                <div class="text-center pb-4">@lang('home.page_creation_interface_text')</div>
                                            </li>
                                            <li class="splide__slide">
                                                <div class="splide__slide__container">
                                                    <img src="{{ asset('img/screenshots/character_creation.webp') }}"
                                                        class="w-100 preview" data-toggle="modal" data-target="#modalImage">
                                                </div>
                                                <div class="text-center pb-4">@lang('home.character_creation_interface_text')</div>
                                            </li>
                                            <li class="splide__slide">
                                                <div class="splide__slide__container">
                                                    <img src="{{ asset('img/screenshots/story_creation.webp') }}"
                                                        class="w-100 preview" data-toggle="modal" data-target="#modalImage">
                                                </div>
                                                <div class="text-center pb-4">@lang('home.story_creation_interface_text')</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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
                            <img src="{{ asset('img/btn_google_signin_dark_normal_web.png') }}"> </a>
                    </div>
                    <div class="card-footer text-center text-muted">
                        {!! trans('auth.users_count', ['count' => \App\Models\User::whereNotIn('role', ['temp'])->count()]) !!}
                    </div>
                </div>
            </div>
            <div class="col mt-5 mt-md-0">
                <div class="card">
                    <div class="card-header">
                        @lang('user.anonymous.title')
                    </div>
                    <div class="card-body">
                        <p>@lang('user.anonymous.description')</p>
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-primary" href="{{ route('story.play.anonymous') }}">@lang('auth.login')</a>
                    </div>
                </div>
{{--                @include('stories.partials.story_card', ['story' => $tutoStory, 'anonymous' => true])--}}
            </div>
        </div>
    </div>

    <!-- Modal Image -->
    @include('page.partials.modals.modal_image')
@endsection
