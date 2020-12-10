@extends('emails.template')

@section('body')
    <div>
        @lang('inbox.form.from') {{ $user->username }}
    </div>
    <div>
        {!! $body !!}
    </div>
@endsection
