<div class="media mb-3" id="message-{{ $message->id }}">
    @if ($authUser->id === $message->user->id)
        <img class="align-self-start rounded-circle mr-3" src="{{ optional($message->user)->avatar }}"
            alt="{{ optional($message->user)->name }}" width="40px">
    @endif
    <div class="media-body pl-3 pb-3 {{ $message->user_id == auth()->id() ? 'bg-light mr-5' : 'bg-primary text-light ml-5' }}">
        <h5 class="mt-0">{{ optional($message->user)->name }}</h5>
        <div class="lead position-relative pb-4">
            {!! $message->body !!}
            <span title="{{ $message->created_at }}"
                    class="font-smaller inbox-message-date position-absolute">
                <span class="moment_date @if ($authUser->id !== $message->user->id) text-white @endif">{{ $message->created_at }}</span>
                @if (!$message->isRead())
                    <span class="icon-hidden" title="@lang('inbox.not_seen')"></span>
                @endif
            </span>
        </div>
    </div>
    @if ($authUser->id !== $message->user->id)
        <img class="align-self-start rounded-circle mr-3" src="{{ optional($message->user)->avatar }}"
            alt="{{ optional($message->user)->name }}" width="40px">
    @endif
</div>
