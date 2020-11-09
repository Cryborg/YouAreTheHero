@extends('base', ['fluid' => false])

@section('content')

    <div class="card">
        <div class="card-header">
            @lang('inbox.title')
            <span class="icon-add btn btn-primary" data-target="#modalAddMessage" data-toggle="modal"></span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    @include('inbox.partials.nav')
                </div>
{{--                Cached threads --}}
                <div id="cached-threads" class="hidden"></div>

{{--                Visible thread--}}
                <div class="col-9" id="visible-thread"></div>
            </div>
        </div>
    </div>

    <!-- Modal add choice -->
    @include('page.partials.modal_model', [
        'template' => 'inbox.partials.modal_create',
        'context' => 'add_message',
        'title' => trans('inbox.new_message_label'),
        'icon' => 'icon-add',
        'big' => false,
        'data' => [
            'recipients' => $recipients,
            'multiple' => $multiple,
            'id' => 'AddMessage',
            'btn_add_text' => trans('common.save')
        ]
    ])
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        @include('inbox.js.inbox-js')
    </script>
@endpush
