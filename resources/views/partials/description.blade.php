<a tabindex="0" role="button" data-trigger="hover" data-placement="top" data-toggle="popover"
    title="" data-content="{{ $content }}"
    data-original-title="{!! htmlentities($link_text) !!}">
    @if ($icon !== false)
        <span class="icon-hidden text-lightgrey mr-1"></span>
    @endif
    {!! $link_text !!}
</a>
