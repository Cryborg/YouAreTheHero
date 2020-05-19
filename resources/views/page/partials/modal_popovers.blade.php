@info({!! trans('page.descriptions_help') !!})

<div class="container">
    @foreach($descriptions as $description)
        <div class="panel panel-default w-100">
            <div class="panel-heading">
                {{ $description->placeholder }}
            </div>
            <div class="panel-body">
                <div class="summernote">
                    {!! $description->description !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
