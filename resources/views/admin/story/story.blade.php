<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/themes/default/style.min.css"/>
@routes
{!! $_content_ !!}

<div id="pages">

</div>


<br>


<div id="container">
</div>
<script>
    $(function () {
        $('#container').jstree({
            'core': {
                'data': {
                    "url": "{{ route('admin.story.pages.json', ['id' => $story_id]) }}",
                    "data": function (node) {
                        return {"id": node.id};
                    }
                }
            }
        });
    });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/jstree.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#container').on("changed.jstree", function (e, data) {
            let story_id = "{{ $story_id }}";
            $.ajax({
                url: route('page.form', {page_number : data.node.id, story_id: story_id }),
            }).done(function (data) {
                $('#pages').html(data);
                // Soumettre la page
                $("#pages form button[type='submit']").on('click', function () {
                    let content = $("textarea[name='content']").val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('admin.page.store') }}',
                        data: {story_id: "{{ $story_id }}", content: content},
                        method: 'POST'
                    }).done(function (data) {
                        console.log(data);
                    });

                    return false;
                });
            });
        });
    });
</script>
