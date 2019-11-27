{!! $_content_ !!}
<button id="create-first-page">Créer la première page</button>

<div id="pages">

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#create-first-page').on('click', function(){
            $.ajax({
                url: '{{ route('page.form') }}',
            }).done(function(data) {
                $('#pages').html(data);
                $("#pages form button[type='submit']").on('click', function(){
                    let content = $('#description').val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('admin.page.store') }}',
                        data: {story_id: "{{ $story_id }}", description: content },
                        method: 'POST'
                    });

                    return false;
                });
            });
        });


    });
</script>
