@extends('base')

@section('title', $title)

@section('content')
    {{-- Parent page(s) --}}
    @if (!$page->is_first)
        @info({!! trans('page.parent_pages_help') !!})
    @else
        @foreach($page->parents() as $key => $parent)
            <div class="tab-pane active" id="p{{ $key }}">
                @include('page.partials.create', ['page' => $parent])
            </div>
        @endforeach
    @endif

    {{-- Current page --}}
    @info({!! trans('page.current_page_help') !!})

    {!! Form::hidden('page_from', $page->id, ['id' => 'page_from']) !!}
    <div>
        @include('page.partials.create')
    </div>

    <hr>

    {{-- Choice(s) --}}
    @info({!! trans('page.current_page_choices_help') !!})

    <div>
        <nav class="nav nav-pills" id="choicesList">
            @if($page->choices)
                @foreach($page->choices as $key => $choice)
                    <a class="nav-item nav-link active" href="#p{{ $key }}" data-toggle="tab">
                        <span class="choice_title_{{ $key }}">
                            <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-{{ $key }}" value="{{ $choice->link_title }}">
                        </span>
                    </a>
                @endforeach
            @endif
            <a class="nav-item nav-link" href="" id="addNewPage">+</a>
        </nav>
        <div class="tab-content" id="choicesForm">
            @if($page->choices)
                @foreach($page->choices as $key => $choice)
                    <div class="tab-pane active" id="p{{ $key }}">
                        @include('page.partials.create', ['page' => $choice])
                    </div>
                @endforeach
            @endif
        </div>
    </div>

@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            // Create a new tab
            $('#addNewPage').on('click', function(event) {
                var $this = $(this);

                event.preventDefault();

                $this.prop('disabled', true);

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
                    'url': route('page.create', {{ $page->story_id }}),
                    'data': {'internalId': newNumber}
                })
                .done(function (data) {
                    $('#choicesForm').append('<div class="tab-pane active" id="p' + newNumber + '">' + data + '</div>');
                })
                .always(function () {
                    $this.prop('disabled', false);
                });
            });

            function checkForm($form)
            {
                var internalId = $form.data('internalid');
                var pageLinkTitle = $('#linktext-' + internalId).val();
                var hasErrors = false;
                var errors = [];

                if (internalId !== 0 && pageLinkTitle.trim() === '') {
                    hasErrors = true;
                    errors.push('link_title');
                }

                if (errors.length === 0) {
                    $('.form-errors').addClass('hidden');
                } else {
                    $.each(errors,  function (key, error) {
                        $('.form-errors').append('<div class="error">' + error + '</div>');
                    });

                    $('.form-errors').removeClass('hidden');
                }

                return hasErrors === false;
            }

            $(document).on('click', '.submit-btn', function (e) {
                let $this = $(this).parent('form');
                e.preventDefault();

                // internalId is 0 if the form being submitted is the main page.
                // Otherwise it is > 0
                var internalId = $this.data('internalid');
                var pageLinkTitle = $('#linktext-' + internalId).val();

                // if (checkForm($this) === false) {
                //     return false;
                // }

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
    </script>
@endpush
