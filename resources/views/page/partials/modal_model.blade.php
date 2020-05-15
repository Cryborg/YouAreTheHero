<div class="modal" id="modal{{ $data['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $data['id'] }}Title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="{{ $icon }} text-black display-5 mr-3 shadow"></span>
                <h5 class="modal-title" id="modal{{ $data['id'] }}Title">{{ $title }}</h5>
                <span class="close toggle-help glyphicon glyphicon-question-sign">
                    </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body shadow-sm">
                @if (!$async)
                    @isset($data['page'])
                        @include($template, ['page' => $data['page']])
                    @endisset
                @endif
            </div>
            <div class="modal-body modal-body-preview h-100 hidden">
                <button type="button" class="close" data-dismiss="modal-preview" aria-label="Fermer">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="modal-preview-content"></div>
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
                        $('#modalAllPages .modal-body:not(.modal-body-preview)').html(html);

                        showHumanReadableDates();
                    });
            });

            $('[data-dismiss="modal-preview"]').on('click', function () {
                $('.modal-body-preview').addClass('hidden');
                $('.modal-preview-content').html('');
            });

            $(document).on('click', '.button-preview', function (event) {
                event.stopImmediatePropagation();

                var $this = $(this);

                $('.modal-body-preview').removeClass('hidden');
                $('.modal-preview-content').html('');

                $(['parents', 'choices']).each(function (id, source) {
                    var data = $this.data(source);

                    $(data).each(function (id, val) {
                        var colWidth = data.length === 1 ? '12' : '6';
                        $('#modalAllPages .card[data-pageid="' + val + '"]')
                            .clone()
                            .appendTo('.modal-preview-content')
                            .wrap('<div class="col-' + colWidth + '"></div>');
                    });

                    $('.modal-preview-content').wrapInner('<div class="row"></div>');
                });

            });
        </script>
    @endpush
@endif
