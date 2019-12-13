@extends('base')

@section('title', $title)

@section('content')
    {{-- Parent page(s) --}}
    @if (!$page->is_first)
        <div class="row">
            <div class="col col-border col-parents">
                @info({!! trans('page.parent_pages_help') !!})

                <div>
                    <div class="tab-content">
                        @if($page->parents())
                            @foreach($page->parents() as $key => $parent)
                                <div class="tab-pane active" id="pp{{ $key }}">
                                    @include('page.partials.create_readonly', ['page' => $parent])
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <nav class="nav nav-pills" id="choicesList">
                        @if($page->parents())
                            @foreach($page->parents() as $key => $choice)
                                <a class="nav-item nav-link @if ($key === 0) active @endif" href="#pp{{ $key }}" data-toggle="tab">
                                <span class="choice_title_{{ $key }}">
                                    <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" value="{{ $choice->link_text }}">
                                </span>
                                </a>
                            @endforeach
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    @endif

    <hr>

    {{-- Current page --}}
    {!! Form::hidden('page_from', $page->id, ['id' => 'page_from']) !!}
    <div class="row" id="current_page">
        <div class="col col-border col-current">
            @info({!! trans('page.current_page_help') !!})

            @include('page.partials.create', ['readonly' => false])
        </div>
    </div>

    <hr>

    {{-- Choice(s) --}}
    <div class="row">
        <div class="col col-border col-choices">
            @info({!! trans('page.current_page_choices_help') !!})

            <nav class="nav nav-pills" id="choicesList">
                @if($page->choices())
                    @foreach($page->choices() as $key => $choice)
                        <a class="nav-item nav-link @if ($key === 0) active @endif" href="#p{{ $key }}" data-toggle="tab">
                            <span class="choice_title_{{ $key }}">
                                <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-{{ $key + 1 }}" value="{{ $choice->link_text }}">
                            </span>
                        </a>
                    @endforeach
                @endif
                <a class="nav-item nav-link" href="" id="addNewPage">+</a>
                <a class="nav-item nav-link" href="">
                    <select class="form-control mr-sm-2" id="childrenSelect">
                        <option value="0" selected>{{ trans('page.existing_page') }}</option>
                        @foreach ($page->getPotentialChildren() as $existingPage)
                            @if ($existingPage->id !== $page->id)
                                <option value="{{ $existingPage->id }}">{{ $existingPage->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </a>
            </nav>
            <div class="tab-content" id="choicesForm">
                @if($page->choices())
                    @foreach($page->choices() as $key => $choice)
                        <div class="tab-pane @if ($key === 0) active @endif" id="p{{ $key }}">
                            @include('page.partials.create', ['page' => $choice, 'internalId' => $key + 1, 'readonly' => false])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection

@push('footer-scripts')
    <script type="text/javascript">
        function newPage($this, route)
        {
            var newNumber = $('a.nav-item.nav-link').length;
            $('a.nav-item.nav-link, div.tab-pane').removeClass('active');

            $('#addNewPage').before(
                '<a class="nav-item nav-link active" href="#p' + newNumber + '" data-toggle="tab">' +
                '<span class="choice_title_' + newNumber + '">' +
                '<input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-' + newNumber + '">' +
                '<div class="alert alert-error hidden"></div>' +
                '</span></span>' +
                '</a>');
            $.ajax({
                'url': route,
                'data': {'internalId': newNumber}
            })
                .done(function (data) {
                    $('#choicesForm').append('<div class="tab-pane active" id="p' + newNumber + '">' + data + '</div>');
                })
                .always(function () {
                    $this.prop('disabled', false);
                });
        }

        $(document).ready(function () {
            // Create a new tab
            $('#addNewPage').on('click', function(event) {
                event.preventDefault();

                var $this = $(this);
                $this.prop('disabled', true);

                newPage($this, route('page.create', {{ $page->story_id }}));
            });

            $(document).on('click', '.submit-btn', function (e) {
                let $this = $(this).parent('form');
                e.preventDefault();

                // internalId is 0 if the form being submitted is the main page.
                // Otherwise it is > 0
                var internalId = $this.data('internalid');
                var pageLinkTitle = $('#linktext-' + internalId).val();

                var data = $this.serialize();
                if (internalId > 0) data += '&linktitle=' + encodeURIComponent(pageLinkTitle);
                data += '&page_from=' + $('#page_from').val();

                $.ajax({
                    method: $this.attr('method'),
                    url: $this.attr('action'),
                    data: data
                })
                    .done(function (data) {
                    })
                    .fail(function (data) {
                        if(data.status == 422) {
                            $.each(data.responseJSON.errors, function (i, error) {
                                $this
                                    .find('[name="' + i + '"]')
                                    .addClass('input-invalid')
                                    .next()
                                    .append(error[0])
                                    .removeClass('hidden');
                            });
                        }
                    });
            });
        });

        $('.nav-item.nav-link select').on('click', function(e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.val() == 0) return false;

            $this.prop('disabled', true);

            newPage($this, route('page.create', [{{ $page->story_id }}, $this.val()]));

            $("#childrenSelect option:selected").remove();
        });
    </script>
@endpush
