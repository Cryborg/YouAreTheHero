<div class="card">
    <div class="card-header">
        <div>
            <b>From:</b> {{ $message->user_from->username }}
        </div>
        {{ $message->subject }}
    </div>
    <div class="card-body">
        {{ $message->body }}
    </div>
    <div class="card-footer text-right">
        <small>
            <span class="moment_date">{{ $message->created_at }}</span>
        </small>
    </div>
</div>
