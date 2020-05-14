<div class="modal" id="modal{{ $data['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $data['id'] }}Title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal{{ $data['id'] }}Title">{{ $title }}</h5>
                <span class="close toggle-help glyphicon glyphicon-question-sign">
                    </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!$async)
                    @isset($data['page'])
                        @include($template, ['page' => $data['page']])
                    @endisset
                    @isset($data['story'])
                        @include($template, ['pages' => $data['story']->pages->sortBy('created_at')->sortByDesc('is_first')->sortBy('is_last')])
                    @endisset
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('common.close')</button>
                @isset($data['btn_add_text'])
                    <button type="button" class="btn btn-success" id="add_{{ $data['id'] }}"
                        data-original-text="{{ $data['btn_add_text'] }}">{{ $data['btn_add_text'] }}</button>
                @endisset
            </div>
        </div>
    </div>
</div>

@if ($async)
    @push('footer-scripts')
        <script>
            $('#modalAllPages').on('show.bs.modal', function (event) {
                $.get({
                    url: route('page.modal.ajax', {story: {{ $data['story']->id }}})
                })
                    .done(function (html) {
                        $('.modal-body').html(html);
                    });
            });
        </script>
    @endpush
@endif
