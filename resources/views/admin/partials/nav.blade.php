<div class="card">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="{{ route('admin.stories') }}" class="stretched-link">{{ trans('admin.statistics_title') }}</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('admin.users') }}" class="stretched-link">{{ trans('admin.users_title') }}</a>
        </li>
        <li class="list-group-item">
            <a href="{{ url('/translations') }}" class="stretched-link" target="_blank">{{ trans('admin.locale_title') }}</a>
        </li>
    </ul>
</div>
