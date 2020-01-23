@extends('base')

@section('title', $title)

@section('content')
    <div class="row m-5">
        <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
            <h1 class="text-center">&nbsp;</h1>
            @include('admin.partials.nav', ['active' => 1])
        </div>
        <div class="col-md-8 col-lg-9 col-xl-10">
            <h1>{{ trans('admin.statistics_title') }}</h1>
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ trans('admin.total_users') }}
                            <span class="badge badge-primary badge-pill">{{ $usersCount }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ trans('admin.total_stories') }}
                            <span class="badge badge-primary badge-pill">{{ $storiesCount }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
