@extends('base')

@section('title', trans('admin.title') . ' - ' . $title)

@section('content')
    <div class="row m-5">
        <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
            <h1 class="text-center">&nbsp;</h1>
            @include('admin.partials.nav', ['active' => 2])
        </div>
        <div class="col-md-8 col-lg-9 col-xl-10">
            <h1>{{ trans('admin.users_title') }}</h1>
            <table class="dataTable">
                <thead>
                    <th>{{ trans('common.id') }}</th>
                    <th>{{ trans('auth.username') }}</th>
                    <th>{{ trans('auth.email') }}</th>
                    <th>{{ trans('stories.number_stories') }}</th>
                    <th>{{ trans('stories.number_games') }}</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                {{ $user->username }}

                                @if ($user->isAdmin())
                                    <span class="badge badge-primary">Admin</span>
                                @endif
                                @if ($user->isModerator())
                                    <span class="badge badge-success">Moderator</span>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->stories->count() }} / {{ $user->stories->where('is_published', false)->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
