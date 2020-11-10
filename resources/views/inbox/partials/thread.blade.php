<div class="w-100 thread clickable list-group-item {{ !$thread->isUnread() ? 'read' : '' }}" data-threadid="{{ $thread->id }}">
    <div class="row">
        <div class="col-9">
            @if($thread->isUnread())
                <span class="badge badge-success">New</span>
            @endif

            {{-- List of the participants --}}
            <span class="d-inline-block">
                @foreach ($thread->participants as $participant)
                    @if ($participant->id !== $authUser->id)
                        {{ $participant->username }}
                    @endif
                @endforeach
            </span>
        </div>
        <div class="col-3 text-right">
            <span class="badge badge-warning text-right">{{ $thread->messages->count() }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <small class="text-muted">{{ $thread->updated_at->diffForHumans() }}</small>
        </div>
    </div>
</div>
