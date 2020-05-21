@info({!! trans('page.descriptions_help') !!})

<div class="container">
    <button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add popover</button>
    @foreach($descriptions as $description)
        <div class="card w-100">
            <h5 class="card-header">
                {{ $description->placeholder }}
            </h5>
            <div class="card-body">
                <div class="card-text">
                    <div class="summernote">
                        {!! $description->description !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
