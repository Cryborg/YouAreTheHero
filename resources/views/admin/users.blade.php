@extends('base')

@section('title', $title)

@section('content')
    <div class="row m-5">
        <div class="col-lg-2">
            @include('admin.partials.nav')
        </div>
        <div class="col-lg-10">
            <h1>{{ trans('admin.users_title') }}</h1>
            <table class="dataTable">
                <thead>
                    <th>{{ trans('auth.id') }}</th>
                    <th>{{ trans('auth.email') }}</th>
                    <th>{{ trans('stories.number_total') }}</th>
                    <th>{{ trans('stories.number_draft') }}</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->stories->count() }}</td>
                            <td>{{ $user->stories->where('is_published', false)->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
