@foreach(\App\Classes\Constants::FUNCTIONS_LIST as $function)
    <div class="p-2 w-100 clickable highlight-hover"
            data-value="@lang('functions.' . $function . '.syntax')"
            title="@lang('functions.' . $function . '.help')">
        @lang('functions.' . $function . '.label')
    </div>
@endforeach
