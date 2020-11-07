@extends('base', ['fluid' => false])

@section('content')

    <div class="card">
        <div class="card-header">
            @lang('inbox.title')
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    @include('inbox.partials.nav')
                </div>
                <div class="col-9" id="messages">

                </div>
            </div>
        </div>
    </div>

@endsection

@push('footer-scripts')
    <script type="text/javascript">
        @include('inbox.js.inbox-js')
    </script>
@endpush
