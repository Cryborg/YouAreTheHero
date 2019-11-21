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
            <span class="pick-item" data-verb="{{ $item['verb'] }}" data-amount="{{ $item['amount'] }}">
                {{ $item['item'] }}
            </span>
        @endforeach
    @endif
@endsection

@section('footer-scripts')
    <script type="text/javascript">
        $('.pick-item').on('click', function() {
            var $this = $(this);
            var verb = $this.data('verb');
            var amount = $this.data('amount');

            alert(verb + ' ' + amount + '?');
        });
    </script>
@endsection
