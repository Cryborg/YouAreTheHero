<div class="media mb-3" id="message-{{ $message->id }}">
    @if ($authUser->id === $message->user->id)
        <img class="align-self-start rounded-circle mr-3" src="img/avatars/{{ optional($message->user)->avatar }}"
            alt="{{ optional($message->user)->name }}" width="40px">
    @endif
    <div class="media-body pl-3 pb-3 {{ $message->user_id == auth()->id() ? 'bg-light mr-5' : 'bg-primary text-light ml-5' }}">
        <h5 class="mt-0">{{ optional($message->user)->name }}</h5>
        <div class="lead">
            {!! $message->body !!}
        </div>
    </div>
    @if ($authUser->id !== $message->user->id)
        <img class="align-self-start rounded-circle mr-3" src="img/avatars/{{ optional($message->user)->avatar }}"
            alt="{{ optional($message->user)->name }}" width="40px">
    @endif
</div>
