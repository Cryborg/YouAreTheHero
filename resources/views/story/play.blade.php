@extends('layouts.' . $layout)

@section('title', $title)

@section('content')
    <p>{!! $page->description !!}</p>
@endsection

@section('choices')
    @if ($page->choices != 'gameover')
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
            <span class="pick-item" data-verb="{{ $item['verb'] }}" data-item="{{ $item['item']['id'] }}">
                {{ $item['item']['name'] }} ({{ __('common.price', ['price' => $item['item']['default_price']]) }})
            </span>
        @endforeach
    @endif
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $(function() {
            $('.inventory-block').load('{{ url('story/inventory/' . $character->id) }}');

            $('.pick-item').on('click', function() {
                var $this = $(this);
                var verb = $this.data('verb');
                var item = $this.data('item');

                $.ajax({
                    'method': 'POST',
                    'url': '{{ url('story/ajax_action') }}',
                    'data': {'item': item, 'verb': verb},
                })
                .done(function(rst) {
                    if (rst.result === true) {
                        $('#character_money').html(rst.money);

                        $('.inventory-block').load('{{ url('story/inventory/' . $character->id) }}');
                    }
                });
            });
        });
    </script>
@endpush
