@extends('layouts.' . $layout)

@section('title', $title)

@section('choices')
    @include('story.partials.choices', ['page' => $page, 'story' => $story])
@endsection

@section('items')
    @if ($page->items)
        @foreach ($page->items as $item)
            @switch($item['verb'])
                @case ('buy')
                @case ('earn')
                    <div class="pick-item" data-verb="{{ $item['verb'] }}" data-item="{{ $item['item']['id'] }}" data-price="{{ $item['item']['default_price']  }}" data-singleuse="{{ $item['item']['single_use'] }}">
                        @include('story.partials.money', [
                            'value' => $item['item']['default_price'],
                            'operator' => 'sub'
                        ])
                        <span class="item-name">{{ $item['item']['name'] }}</span>
                        @foreach ($item['item']['effects'] as $effect => $value)
                            @include('story.partials.effects', [
                                'name' => $effect,
                                'value' => $value['quantity'],
                                'operator' => $value['operator'] === '+' ? 'add' : 'sub'
                            ])
                        @endforeach
                    </div>
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
            loadChoices();
        });

        function loadInventory() {
            $('.inventory-block').load('{{ url('story/' . $story->id . '/inventory') }}', function () {
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
                                    loadSheet();
                                    loadChoices();
                                }
                            });
                        });
                    }
                });
            });
        }

        function loadSheet() {
            $('.sheet-block').load('{{ url('story/' . $story->id . '/sheet') }}');
        }

        function loadChoices() {
            $('.choices-block').load('{{ url('story/' . $story->id . '/' . $page->id . '/choices') }}');
        }
    </script>
@endpush
