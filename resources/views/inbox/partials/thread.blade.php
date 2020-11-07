<div class="thread clickable list-group-item {{ !$thread->isUnread() ? 'read' : '' }}" data-threadid="{{ $thread->id }}">
    @if($thread->isUnread())
        <span class="badge badge-success">New</span>
    @endif

    <span class="d-inline-block mr-5">{{ $thread->user->username }}</span>
    <span class="badge badge-danger">{{ $thread->messages->count() }}</span>
    <span class="float-right badge badge-secondary ml-2">{{ $thread->updated_at->diffForHumans() }}</span>
</div>
