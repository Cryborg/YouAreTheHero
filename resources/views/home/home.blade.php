@extends('base')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('home.welcome')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! trans('home.text')  !!}
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
