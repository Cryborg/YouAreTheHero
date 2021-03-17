<div class="modal" id="modal{{ $data['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $data['id'] }}Title" aria-hidden="true">
    <div class="modal-dialog @if($big) modal-xl @endif modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="{{ $icon }} display-5 mr-3 shadow"></span>
                <h5 class="modal-title" id="modal{{ $data['id'] }}Title">{{ $title }}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body shadow-sm h-50">
                @if ($context === 'rating')
                    @include($template, ['story' => $story])
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

@if ($context === 'rating')
    @push('footer-scripts')
        @include('layouts.js.rating-js')
    @endpush
@endif
