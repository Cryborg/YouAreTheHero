{!! $_content_ !!}
<button id="create-first-page">Créer la première page</button>

<div id="pages">

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#create-first-page').on('click', function(){
            $.ajax({
                url: '{{ route('page.form') }}',
                data: '{story_id: {{ $story_id }} }'
            }).done(function(data) {
                $('#pages').html(data);
                $("#pages form button[type='submit']").on('click', function(){
                    let content = $('#description').val();
                    $.ajax({
                        url: '{{ route('admin.page.create') }}',
                        data: '{story_id: {{ $story_id }}, content: '+content+' }'
                    });

                    return false;
                });
            });
        });


    });
</script>
