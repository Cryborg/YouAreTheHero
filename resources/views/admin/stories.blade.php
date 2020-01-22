@extends('base')

@section('title', $title)

@section('content')
    <div class="row m-5">
        <div class="col-lg-2">
            @include('admin.partials.nav')
        </div>
        <div class="col-lg-10">
            Divers résumés :<br>
            - nombre d'utilisateurs
            - nombre d'histoires published/draft
        </div>
    </div>
@endsection
