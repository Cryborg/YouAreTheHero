@extends('layouts.' . $layout)

@section('title', $title)

@section('choices')
    @if ($page->choices !== 'gameover')
        <fieldset>
            <legend>@lang('play.choices')@lang('common.:')</legend>
            <ul>
                @foreach ($page->choices as $choice)
                    <li><a href="{{ url('story/' . $story->id . '/' . $choice->page_to) }}">{!! $choice->link_text !!}</a></li>
                @endforeach
            </ul>
        </fieldset>
    @endif
@endsection

@section('items')
    @if ($page->items)
        @foreach ($page->items as $item)
            @switch($item['verb'])
                @case ('buy')
                @case ('earn')
                    <div class="pick-item" data-verb="{{ $item['verb'] }}" data-item="{{ $item['item']['id'] }}" data-price="{{ $item['item']['default_price']  }}" data-singleuse="{{ $item['item']['single_use'] }}">{{
                        $item['item']['name'] }} ({{ __('common.price', ['price' => $item['item']['default_price']])
                    }})</div>
                    @break
            @endswitch
        @endforeach
    @endif
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $(function() {
            loadInventory();
            loadSheet();
        });

        function loadInventory() {
            $('.inventory-block').load('{{ url('story/inventory/' . $character->id) }}', function () {
                $('.pick-item').each(function () {
                    var $this = $(this);

                    // Reset the links
                    $this.unbind('click');
                    $this.removeClass('has-money');

                    // If the character has enough money
                    // OR if the action will credit money
                    if ($('#character_money').html() >= $(this).data('price') || $.inArray($this.data('verb'), ['earn']) > -1) {
                        $this.addClass('has-money');

                        $this.on('click', function()
                        {
                            if ($this.data('singleuse')) {
                                $this.remove();
                            }

                            $.ajax({
                                'method': 'POST',
                                'url': '{{ url('story/ajax_action') }}',
                                'data': {'json': JSON.stringify($this.data())},
                            })
                            .done(function(rst) {
                                if (rst.result === true) {
                                    loadInventory();
                                }
                            });
                        });
                    }
                });
            });
        }

        function loadSheet() {
            $('.sheet-block').load('{{ url('story/sheet/' . $character->id) }}', function () {

            });
        }
    </script>
@endpush
