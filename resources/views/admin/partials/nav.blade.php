<div class="card">
    <ul class="list-group list-group-flush">
        <li class="list-group-item @if ($active === 1) selected-stretched-link @endif">
            <span class="glyphicon glyphicon-stats mr-2"></span>
            <a href="{{ route('admin') }}" class="stretched-link">{{ trans('admin.statistics_title') }}</a>
        </li>
        <li class="list-group-item @if ($active === 2) selected-stretched-link @endif">
            <span class="glyphicon glyphicon-user mr-2"></span>
            <a href="{{ route('admin.users') }}" class="stretched-link">{{ trans('admin.users_title') }}</a>
        </li>
        <li class="list-group-item @if ($active === 3) selected-stretched-link @endif">
            <span class="glyphicon glyphicon-book mr-2"></span>
            <a href="{{ route('admin.stories') }}" class="stretched-link">{{ trans('admin.stories_title') }}</a>
        </li>
    </ul>
</div>
<hr>
<div class="card">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <span class="glyphicon glyphicon-globe mr-2"></span>
            <a href="{{ url('/translations') }}" class="stretched-link" target="_blank">{{ trans('admin.locale_title') }}</a>
        </li>
        <li class="list-group-item">
            <span class="glyphicon glyphicon-remove mr-2"></span>
            <a href="{{ route('admin.clear.cache') }}" class="stretched-link">{{ trans('admin.clear_cache') }}</a>
        </li>
        <li class="list-group-item">
            <span class="glyphicon glyphicon-remove mr-2"></span>
            <a href="{{ route('admin.clear.view') }}" class="stretched-link">{{ trans('admin.clear_view') }}</a>
        </li>
    </ul>
</div>
