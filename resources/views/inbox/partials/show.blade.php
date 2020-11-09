<div class="one-thread" id="thread-{{ $thread->id }}">
    <h4>{{ $thread->subject }}</h4>
    @if($thread->recipients->count() > 1)
        <span class="d-inline-block mr-5">@lang('inbox.form.to')
            @foreach($thread->recipients as $recipient)
                <strong>{{ $recipient->username }}</strong>
                {{ $thread->recipients->last()->id != $recipient->id ? ', ' : '' }}
            @endforeach
        </span>
    @endif

    <hr>

    <div id="messagesList">
        @foreach($messages as $message)
            @include('inbox.partials.message')
        @endforeach
    </div>

    <form class="form-group">
        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
            <textarea id="body" name="body" class="form-control" rows="2" required>{{ old('body') }}</textarea>
            @if ($errors->has('body'))
                <span class="help-block">
                    <b>{{ $errors->first('body') }}</b>
                </span>
            @endif
        </div>

        <div class="clearfix">
            <div class="btn btn-success" id="sendMessage" data-threadid="{{ $thread->id }}">@lang('inbox.form.send')</div>
        </div>
    </form>
</div>
