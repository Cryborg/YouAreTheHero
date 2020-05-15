@extends('base')

@section('content')
    <div class="row h-100">
        <div class="col col-xs-12">
            <div class="row">
                <div class="col">
                    <div class="title">{{ $page->title }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>{!! $page->description !!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @yield('choices')
                </div>
            </div>
            @include('layouts.partials.footer-scripts')
            @stack('footer-scripts')
        </div>
    </div>
@endsection
