@if(Session::has('success'))
    <script type="text/javascript">
        swal({
            title:'Success!',
            text:"{{Session::get('success')}}",
            timer:1500,
            type:'success'
        }).then((value) => {
            //location.reload();
        }).catch(swal.noop);
    </script>
@endif

@if(Session::has('delete_page'))
    <script type="text/javascript">
        swal({
            title:'Success!',
            text:"{{Session::get('delete_page')}}",
            timer:1500,
            type:'success'
        }).then((value) => {
            //location.reload();
        }).catch(swal.noop);
    </script>
@endif


@if( Session::has("error") )
    <div class="alert alert-danger alert-block" role="alert">
        <button class="close" data-dismiss="alert"></button>
        {{ Session::get("error") }}
    </div>
@endif
