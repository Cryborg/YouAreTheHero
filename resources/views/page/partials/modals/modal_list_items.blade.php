@info({!! trans('story.list_all_items_help') !!})
<div class="row">
    @foreach($items as $item)
        <div class="col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ $item->name }}</div>
                    <div class="float-right text-muted">{{ $item->category }}</div>
                </div>
                <div class="card-body p-3">
                    <div class="input-group mb-1">
                        <div class="input-group-prepend w-50">
                            <span class="input-group-text w-100">
                                @lang('item.price')
                            </span>
                        </div>
                        <div class="form-control">
                            {{ $item->default_price }}
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend w-50">
                            <span class="input-group-text w-100">
                                @lang('item.single_use')
                            </span>
                        </div>
                        <div class="form-control">
                            {{ $item->single_use_as_text() }}
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend w-50">
                            <span class="input-group-text w-100">
                                @lang('item.is_unique')
                            </span>
                        </div>
                        <div class="form-control">
                            {{ $item->is_unique_as_text() }}
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend w-50">
                            <span class="input-group-text w-100">
                                @lang('item.is_throwable')
                            </span>
                        </div>
                        <div class="form-control">
                            {{ $item->is_throwable_as_text() }}
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend w-50">
                            <span class="input-group-text w-100">
                                @lang('item.size')
                            </span>
                        </div>
                        <div class="form-control">
                            {{ $item->size }}
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend w-50">
                            <span class="input-group-text w-100">
                                @lang('item.effects')
                            </span>
                        </div>
                        <div class="form-control">
                            @if ($item->fields()->count() > 0)
                                @include('page.partials.badge_fields', ['item' => $item])
                            @endif
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend w-50">
                            <span class="input-group-text w-100">
                                @lang('item.appears_in_pages')
                            </span>
                        </div>
                        <div class="form-control">
                            @foreach ($item->pages as $page)
                                <a href="{{ route('page.edit', ['page' => $page]) }}">{{ $page->present()->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

