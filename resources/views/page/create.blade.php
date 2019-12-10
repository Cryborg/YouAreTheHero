@extends('base')

@section('title', $title)

@section('content')

    {{-- Parent page(s) --}}
    @if (!$page->is_first)
        @info({!! trans('page.parent_pages_help') !!})
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
            @if($choices)
                @foreach($choices as $key => $choice)
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
            @include('page.partials.create', ['page' => $choice])
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

                if (pageLinkTitle.trim() === '') {
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

                var internalId = $this.data('internalid');
                var pageLinkTitle = $('#linktext-' + internalId).val();

                if (checkForm($this) === false) {
                    return false;
                }

                $.ajax({
                    method: $($this).attr('method'),
                    url: $($this).attr('action'),
                    data: $($this).serialize() +
                        '&linktitle=' + encodeURIComponent(pageLinkTitle) +
                        '&page_from=' + $('#page_from').val()
                })
                    .done(function (data) {
                    })
                    .fail(function (data) {

                    });
            });
        });
    </script>
@endpush
