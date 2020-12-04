@if ($hasErrors === false)
    Rien
@else
    <div class="row">
        @if ($deadEnds->count() > 0)
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-header">
                        @lang('page.dead_ends')
                    </div>
                    <div class="card-body">
                        @foreach($deadEnds as $deadEnd)
                            <div class="row mb-1">
                                <div class="col">
                                    <!-- If it is a dead end AND it is flagged as is_first then it is a lone page -->
                                    @if ($deadEnd->is_first)
                                        <a class="btn border-danger border-2 text-center mr-3" role="button">
                                            <span class="icon-trash text-red deletePage" data-pageid="{{ $deadEnd->id }}"></span>
                                        </a>
                                    @endif

                                    <a href="{{ route('page.edit', $deadEnd) }}" class="btn btn-light text-left w-75" role="button">
                                        <span class="icon-fountain-pen text-black mr-3" data-pageid="{{ $deadEnd->id }}"></span>
                                        {{ $deadEnd->present()->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted font-italic font-smaller">
                        @lang('page.dead_ends_help')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
        @endif

        @if ($orphans->count() > 0)
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-header">
                        @lang('page.orphans')
                    </div>
                    <div class="card-body">
                        @foreach($orphans as $orphan)
                            <div class="row mb-1">
                                <div class="col">
                                    <a class="btn border-danger border-2 text-center w-15" role="button">
                                        <span class="icon-trash text-red deleteOrphan" data-pageid="{{ $orphan->id }}"></span>
                                    </a>
                                    <a href="{{ route('page.edit', $orphan) }}" class="btn btn-light text-left w-75" role="button">
                                        <span class="icon-fountain-pen text-black  mr-3" data-pageid="{{ $orphan->id }}"></span>
                                        {{ $orphan->present()->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted font-italic font-smaller">
                        @lang('page.orphans_help')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
        @endif

        @if ($unusedItems->count() > 0)
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-header">
                        @lang('item.unused_items_label')
                    </div>
                    <div class="card-body">
                        @foreach($unusedItems as $item)
                            <div class="row mb-1">
                                <div class="col">
                                    <a class="btn border-danger border-2 text-center w-15 mr-3" role="button">
                                        <span class="icon-trash text-red deleteItem" data-itemid="{{ $item->id }}"></span>
                                    </a>
                                    {{ $item->name }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted font-italic font-smaller">
                        @lang('page.unused_items_help')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
        @endif

        @if ($unusedFields->count() > 0)
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-header">
                        @lang('field.unused_fields')
                    </div>
                    <div class="card-body">
                        @foreach($unusedFields as $field)
                            <div class="row mb-1">
                                <div class="col">
                                    <a class="btn border-danger border-2 text-center w-15 mr-3" role="button">
                                        <span class="icon-trash text-red deleteField" data-fieldid="{{ $field->id }}"></span>
                                    </a>
                                    {{ $field->name }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted font-italic font-smaller">
                        @lang('page.unused_fields_help')
                    </div>
                </div>
            </div>
        @endif
        @if ($emptyRiddles->count() > 0)
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-header">
                        @lang('page.empty_riddles')
                    </div>
                    <div class="card-body">
                        @foreach($emptyRiddles as $riddle)
                            <div class="row mb-1">
                                <div class="col">
                                    <a class="btn border-danger border-2 text-center w-15 mr-3" role="button">
                                        <span class="icon-trash text-red deleteRiddle" data-riddleid="{{ $riddle->id }}"></span>
                                    </a>
                                    <a class="btn btn-light text-left w-75" role="button">
                                        <span class="icon-eye text-black mr-3" data-pageid="{{ $riddle->id }}"></span>
                                        {{ $riddle->parent->present()->title }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-muted font-italic font-smaller">
                        @lang('page.empty_riddles_help')
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif
