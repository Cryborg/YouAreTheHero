<div class="modal" id="modal{{ $data['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $data['id'] }}Title" aria-hidden="true">
    <div class="modal-dialog @if($big) modal-xl @endif modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="{{ $icon }} display-5 mr-3 shadow"></span>
                <h5 class="modal-title" id="modal{{ $data['id'] }}Title">{{ $title }}</h5>
                <span class="close toggle-help glyphicon glyphicon-question-sign">
                    </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body shadow-sm h-50">
                @if (in_array($context, ['prerequisites', 'actions', 'riddles', 'add_choice']))
                    @include($template, ['page' => $data['page']])
                @endif
            </div>
            <div class="modal-body modal-body-preview h-50 ml-3 hidden">
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

@if ($context === 'list_pages')
    @push('footer-scripts')
        <script>
            $(document).on('show.bs.modal', '#modalAllPages', function (event)
            {
                $('#modalAllPages .modal-body:not(.modal-body-preview)').html('');

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
                            .wrap('<div class="col-lg-' + colWidth + ' col-xs-12"></div>');
                    });

                    $('.modal-preview-content').wrapInner('<div class="row"></div>');
                });

            });
        </script>
    @endpush
@endif

@if ($context === 'popovers')
    @push('footer-scripts')
        <script>
            $(document).on('show.bs.modal', '#modalPopovers', function (event) {
                var $this = $(this);

                $('#modalPopovers .modal-body').html('');

                $.get({
                    url: route('page.descriptions', {page: $this.data('pageid')})
                })
                    .done(function (html) {
                        $('#modalPopovers .modal-body').html(html);

                        $('.summernote').summernote(summernoteOptionsLight);
                    });
            });
        </script>
    @endpush
@endif
