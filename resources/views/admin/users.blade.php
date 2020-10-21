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
            <table class="table">
                <thead>
                    <th>{{ trans('common.id') }}</th>
                    <th>{{ trans('auth.username') }}</th>
                    <th>{{ trans('auth.email') }}</th>
                    <th>{{ trans('stories.number_stories') }}</th>
{{--                    <th>{{ trans('stories.number_games') }}</th>--}}
                    <th>{{ trans('common.created_at') }}</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                @if ($user->google_id)
                                    <img src="{{ $user->avatar }}" width="25px" height="25px"
                                        class="profile-picture profile-picture-sm border border-primary border-1"
                                        title="#{{ $user->id }}">
                                @else
                                    {{ $user->id }}
                                @endif
                            </td>
                            <td>
                                @if ($user->role === 'temp')
                                    <span class="text-muted">-</span>
                                @else
                                    <a href="{{ route('user.profile.get', ['user' => $user->id]) }}">
                                        {{ $user->username }}
                                    </a>
                                @endif

                                @if ($user->hasRole('admin'))
                                    <span class="badge badge-primary">Admin</span>
                                @endif
                                @if ($user->hasRole('moderator'))
                                    <span class="badge badge-success">Moderator</span>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->stories->where('is_published', true)->count() }} / {{ $user->stories->where('is_published', false)->count() }}</td>
                            <td class="moment_date">{{ $user->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script>
        showHumanReadableDates();
    </script>
@endpush
