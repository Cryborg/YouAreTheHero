<div class="row threads-list">
    @forelse($threads as $thread)
        @include('inbox.partials.thread')
    @empty
        <div class="list-group-item p-5">
            <h3 class="text-center font-weight-bold">Nothing, nada, nichts!</h3>
        </div>
    @endforelse
</div>
