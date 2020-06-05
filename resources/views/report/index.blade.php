@extends('base')

@section('title', $story->title)

@section('content')
    <div class="card">
        <div class="card-header">
            {{ $story->title }}
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>@lang('page.report_page')</th>
                        <th>@lang('page.report_error_type')</th>
                        <th>@lang('page.report_comment')</th>
                        <th class="d-none d-lg-table-cell">@lang('common.created_by')</th>
                        <th class="d-none d-lg-table-cell">@lang('common.created_at')</th>
                        <th>@lang('common.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>
                                <a href="{{ route('page.edit', ['page' => $report->page->id ]) }}" target="_blank">
                                    {{ $report->page->title }}
                                </a>
                            </td>
                            <td>@lang('page.report_error_type_' . $report->error_type)</td>
                            <td>{!! $report->comment !!}</td>
                            <td class="d-none d-lg-table-cell">{{ $report->user->username }}</td>
                            <td class="d-none d-lg-table-cell moment_date">{{ $report->created_at }}</td>
                            <td>
                                <span class="icon-trash text-red clickable deleteReport" data-reportid="{{ $report->id }}"></span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script>
        @include('report.js.index-js')
    </script>
@endpush
