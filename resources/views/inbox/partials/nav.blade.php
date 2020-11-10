<div class="row threads-list">
    @forelse($threads as $thread)
        @include('inbox.partials.thread')
    @empty
        <div class="list-group-item p-5">
            <h3 class="text-center font-weight-bold">There are no messages</h3>
        </div>
    @endforelse
</div>
