@info({!! trans('page.descriptions_help') !!})

<div class="container">
    <button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add popover</button>
    @foreach($descriptions as $description)
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $description->placeholder }}
                </h5>
                <div class="card-text">
                    <div class="summernote">
                        {!! $description->description !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
