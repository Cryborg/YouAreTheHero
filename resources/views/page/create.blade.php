@extends('base')

@section('title', $title)

@section('content')

    {{-- Parent page(s) --}}

    {{-- Current page --}}
    <div>
        @include('page.partials.create')
    </div>

    <hr>

    {{-- Choice(s) --}}
    <div>
        <nav class="nav nav-pills" id="choicesList">
{{--            <a class="nav-item nav-link active" href="#p1" data-toggle="tab">Onglet 1</a>--}}
            <a class="nav-item nav-link" href="" id="addNewPage" data-toggle="tab">+</a>
        </nav>
        <div class="tab-content" id="choicesForm">
{{--            <div class="tab-pane active" id="p1">--}}
{{--                @include('page.partials.create')--}}
{{--            </div>--}}
        </div>
    </div>

@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $('#addNewPage').on('click', function() {
            var newNumber = $('a.nav-item.nav-link').length;
            $('a.nav-item.nav-link').removeClass('active');
            $('div.tab-pane.active').removeClass('active');

            $('#addNewPage').parent('nav').prepend('<a class="nav-item nav-link active" href="#p' + newNumber + '" data-toggle="tab">Choix ' + newNumber + '</a>');
            $('#choicesForm').append('<div class="tab-pane active" id="p' + newNumber + '">Texte ' + newNumber + '</div>');
        });
    </script>
@endpush
