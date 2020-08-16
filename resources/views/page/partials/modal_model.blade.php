<div class="modal" id="modal{{ $data['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $data['id'] }}Title" aria-hidden="true">
    <div class="modal-dialog @if($big) modal-xl @endif modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="{{ $icon }} display-5 mr-3 shadow"></span>
                <h5 class="modal-title" id="modal{{ $data['id'] }}Title">{{ $title }}</h5>
                <span class="close toggle-help icon-help">
                    </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body shadow-sm h-50">
                {{-- FIX ME, I'm ugly! --}}
                @if (in_array($context, ['prerequisites', 'item_page', 'riddles', 'add_choice', 'edit_choice', 'add_actions', 'report']))
                    @include($template, ['page' => $data['page']])
                @endif
                @if (in_array($context, ['help']))
                    @include($template)
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
        @include('page.js.list_pages-js')
    @endpush
@endif

@if ($context === 'list_items')
    @push('footer-scripts')
        @include('page.js.list_items-js')
    @endpush
@endif

@if ($context === 'descriptions')
    @push('footer-scripts')
        @include('page.js.descriptions-js')
    @endpush
@endif

@if ($context === 'edit_choice')
    @push('footer-scripts')
        @include('page.js.edit_choice-js')
    @endpush
@endif

@if ($context === 'add_actions')
    @push('footer-scripts')
        @include('page.js.add_actions-js')
    @endpush
@endif
