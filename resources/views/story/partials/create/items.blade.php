<div class="row">
    <div class="col">
        @include('item.partials.new_item', ['story' => $story, 'context' => 'story_creation', 'item' => ''])
    </div>
    <div class="col">
        <div class="card">
            <h5 class="card-header">
                @lang('story.existing_items')
            </h5>
            <div class="card-body">
                <div class="card-text itemListDiv">
                    @include('page.js.partials.create.item_list_div', ['items' => $story->items])
                </div>
            </div>
        </div>
    </div>
</div>
