<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/themes/default/style.min.css"/>
@routes
{!! $_content_ !!}

<div id="page">

</div>


<br>


<div id="container">
</div>

<div class="flash-message"></div>
<script>
    // Init tree
    $(function () {
        $('#container').jstree({
            'core': {
                'data': {
                    "url": "{{ route('admin.story.pages.json', ['id' => $story_id]) }}",
                    "data": function (data) {

                        return {"id": data.id};
                    }
                },
            }
        });
    });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/jstree.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        // Click on element tree
        $('#container').on("changed.jstree", function (e, data) {
            let node_id = data.node !== undefined ? data.node.id : 0;

            createPage(e, node_id, 0);
        });
    });

    function createPage(e, node_id, page_parent) {
        let story_id = "{{ $story_id }}";

        $.ajax({
            url: route('page.form', {page_id : node_id, story_id: story_id }),
        }).done(function (data) {
            $('#page').html(data);

            $('#page').find('select').select2();


            // Soumettre la page
            $("#page form button[type='submit']").on('click', function () {
                let content = $("textarea[name='content']").val();
                let page_id = $("input[name='page_id']").val();
                let items = $('#page').find('select').val();

                console.log($('#page').find('select').val());


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('div.flash-message').html(data);
                        $('#container').jstree("refresh");
                    },
                    url: '{{ route('admin.page.store') }}',
                    data: {story_id: "{{ $story_id }}", content: content, page_parent: page_parent, page_id: page_id, items: items},
                    method: 'POST'
                });

            });

            $('#create_new_children_page').on("click", function (e) {

                createPage(e,  0, $("input[name='page_id']").val());
            });

            $('#create_new_page').on("click", function (e) {

                createPage(e, 0);
            });

            $('#delete_page').on("click", function (e) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('div.flash-message').html(data);
                        $('#container').jstree("refresh");
                    },
                    url: '{{ route('admin.page.delete', ['id' => 0]) }}',
                    data: {id: $("input[name='page_id']").val() },
                    method: 'DELETE'
                });
            });
        });
    }
</script>
