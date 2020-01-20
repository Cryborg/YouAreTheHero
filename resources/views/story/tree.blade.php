@extends('base', ['fluid' => true])

@section('title', trans('story.tree'))

@section('content')
    @include('story.partials.treecard', ['pages' => $pages])
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        displayChildren('{{ $pages[0]->uuid }}');

        function displayChildren(pageId) {
            $.ajax({
                url: route('story.ajax_postchildrenpages'),
                method: 'POST',
                data: {page: pageId}
            })
                .done(function (data) {
                    // Displays the children pages and mark the DIV as not empty
                    $('#children_pages_' + pageId).html(data).removeClass('is_empty');

                    // Now we take all empty DIVs and we recursively run this function to fill them
                    $('.children_pages.is_empty').each(function (idx, elt) {
                        if ($('#children_pages_' + $(elt).data('pageid') + '.is_empty').length == 0) {
                            console.log($(elt).data('pageid'));
                            displayChildren($(elt).data('pageid'));
                        }
                    })

                })
                .fail(function () {
                    console.log('error');
                });
        }
    </script>
@endpush
