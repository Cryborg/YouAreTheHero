@extends('layouts.' . $layout)

@section('title', $title)

@section('riddle')
    @if ($page->riddle()->count() > 0)
        @include('story.partials.riddle', ['data' => $page->riddle])
    @endif
@endsection

@section('choices')
    @include('story.partials.choices', ['page' => $page, 'story' => $story])
@endsection

@section('actions')
    <div class="row mt-3">
        <div class="col-xl-6 col-md-12">
            @foreach ($actions as $action)
                @switch($action->pivot->verb)
                    @case ('buy')
                    @case ('take')
                    @case ('sell')
                    @case ('give')
                        <div class="pick-item" data-actionid="{{ $action->pivot->id }}">
                            @include('story.partials.money', [
                                'value' => $action->pivot->price,
                                'icon' => in_array($action->pivot->verb, ['sell','give']) ? 'glyphicon-euro' : 'glyphicon-shopping-cart',
                                'name' => $action->name
                            ])
        {{--                    @if ($action['item']->effects)--}}
        {{--                        @foreach ($action['item']->effects as $effect => $value)--}}
        {{--                            @include('story.partials.effects', [--}}
        {{--                                'name' => $effect,--}}
        {{--                                'value' => $value['quantity'],--}}
        {{--                                'operator' => $value['operator'] === '+' ? 'add' : 'sub'--}}
        {{--                            ])--}}
        {{--                        @endforeach--}}
        {{--                    @endif--}}
                        </div>
                        @break
                @endswitch
            @endforeach
        </div>
    </div>
@endsection

@section('map')
    @foreach ($visitedPlaces as $place)
        <a href="{{ route('story.play', ['story' => $story->id, 'page' => $place->page_id]) }}">{{ $place->page_title }}</a><br>
    @endforeach
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.pick-item').on('click', function () {
                var $this = $(this);

                $.ajax({
                    'method': 'POST',
                    'url': '{{ route('story.ajax_action') }}',
                    'data': {
                        'actionid': $this.data('actionid'),
                        'pageid': {{ $page->id }}
                    },
                })
                    .done(function(rst) {
                        if (rst.result === true) {
                            loadInventory();
                            loadSheet();
                            loadChoices();
                        }
                        if (rst.singleuse === true) {
                            $this.remove();
                        }
                    });
            });

        });

        $(function() {
            loadInventory();
            loadSheet();
            loadChoices();
        });

        function loadInventory() {
            $('.inventory-block').load('{{ route('story.inventory', ['story' => $story->id]) }}');
        }

        function loadSheet() {
            $('.sheet-block').load('{{ route('story.sheet', ['story' => $story->id]) }}');
        }

        function loadChoices() {
            $('.choices-block').load('{{ route('story.choices', ['story' => $story->id, 'page' => $page->id]) }}');
        }

        @if ($page->riddle()->count())
            $('#riddle_validate').on('click', function () {
                $this = $(this);

                // Toggle disabled state
                $this.prop('disabled', (i, v) => !v);

                $.post({
                    url: route('page.riddle.validate', {'page': '{{ $page->id }}'}),
                    data: {
                        'answer': $('#riddle_answer').val()
                    }
                })
                    .done(function (data) {
                        if (data.success) {
                            $('#riddle_block').html(data.itemResponse);

                            if (data.refreshInventory !== false) {
                                loadInventory();
                                loadChoices();
                            }
                        } else {
                            $this.parents('.panel').addClass('panel-danger');
                        }
                    })
                    .fail(function (data) {
                        $this.parents('.panel').addClass('panel-danger');
                    })
                    .always(function () {
                        // Toggle disabled state
                        $this.prop('disabled', (i, v) => !v);

                        setTimeout(function() {
                            $this.parents('.panel').removeClass('panel-danger');
                        }, 3000);
                    });
            });
        @endif
    </script>
@endpush
