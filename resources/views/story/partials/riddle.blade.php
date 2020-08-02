<div class="row">
    <div class="col-12">
        <div class="card border">
            <h5 class="card-header">
                @if ($page->riddle && $page->riddle->title)
                    {{ $page->riddle->title }}
                @else
                    @lang('page.riddle_header')
                @endif
            </h5>
            <div class="card-body">
                <p class="card-text riddle-block"></p>
                    @if ($page->riddle->isSolved())
                        @lang('page.riddle_already_solved')
                    @else
                        <div class="riddle_text">
                            @if ($page->riddle->type === 'integer')
                                <div class="form-inline">
                                    @for ($i = 1, $iMax = strlen($page->riddle->answer); $i <= $iMax; $i++)
                                        <div id="number-spinner-vertical-{{ $i }}" class="t-neutral">
                                            <fieldset class="spinner spinner--vertical">
                                                <button data-type="add" class="spinner__button spinner__button--top" title="Add 1" aria-controls="spinner-input-{{ $i }}">+</button>
                                                <input type="number" class="spinner__input js-spinner-input-vertical font-bigger" id="spinner-input-{{ $i }}" value="1" step="1"  max="9" min="0" pattern="[0-9]*" role="alert" aria-live="assertlive" />
                                                <button data-type="subtract" class="spinner__button spinner__button--bottom" title="Subtract 1" aria-controls="spinner-input-{{ $i }}">-</button>
                                            </fieldset>
                                        </div>
                                    @endfor
                                </div>
                            @endif
                            <div class="input-group mb-3">
                                <input id="riddle_answer" type="text" class="form-control @if ($page->riddle->type === 'integer') hidden @endif">
                                <div class="input-group-prepend">
                                    <button id="riddle_validate" class="btn btn-outline-secondary" type="button">@lang('common.btn_validate')</button>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
    <script>
        const spinnerInputLength = {{ strlen($page->riddle->answer) }};

        @for ($i = 1, $iMax = strlen($page->riddle->answer); $i <= $iMax; $i++)
            NumberSpinner('spinner-input-{{ $i }}', 'reverse');
        @endfor

        $(document).on('click', '.spinner__button', function () {
            var answer = '';

            $('.spinner__input').each(function (index) {
                answer += $(this).val();
            });

            $('#riddle_answer').val(answer);
        });
    </script>
@endpush
