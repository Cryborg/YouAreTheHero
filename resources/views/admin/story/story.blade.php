<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/themes/default/style.min.css" />

{!! $_content_ !!}

<div id="pages">

</div>


<br>


<div id="container"></div>
<script>
    $(function() {
        $('#container').jstree({
            'core' : {
                'data' : [
                    { "text" : "Root node", "children" : [
                            { "text" : "Child node 1", 'children': [{ "text" : "Child node 1_1" }] },
                            { "text" : "Child node 2" }
                        ]
                    }
                ]
            }
        });
    });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/jstree.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#container').on("changed.jstree", function (e, data) {
            console.log("The selected nodes are:");
            console.log(data.node.parent);
            if (data.node.parent === '#') {
                $.ajax({
                    url: '{{ route('page.form') }}',
                }).done(function(data) {
                    $('#pages').html(data);

                    // Soumettre la page
                    $("#pages form button[type='submit']").on('click', function(){
                        let content = $("textarea[name='content']").val();
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{ route('admin.page.store') }}',
                            data: {story_id: "{{ $story_id }}", content: content, is_first: true },
                            method: 'POST'
                        }).done(function(data) {
                            console.log(data);
                        });

                        return false;
                    });
                });
            }
        });
    });
</script>
