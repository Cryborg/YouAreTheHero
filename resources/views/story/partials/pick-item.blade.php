<div class="input-group">
    <div class="input-group-prepend">
        <button class="btn btn-outline-secondary" type="button" data-itemid="{{ $item->id }}">
            <span class="glyphicon {{ $icon }} mr-2"></span>
            {!! $item->sellingPrice() !!}
        </button>
    </div>
    <span class="form-control" aria-label="Item price" aria-describedby="basic-addon1">{{ $item->name }}</span>
</div>
