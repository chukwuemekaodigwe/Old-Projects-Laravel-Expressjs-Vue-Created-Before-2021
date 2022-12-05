
@if(Session::has('message'))
<button type="button" class="close" data-dismiss="alert" style="float:right;">×</button>
<p class="alert text-center {{ Session::get('alert-class', 'alert-info') }}"><i> {!!
Session::get('message') !!}
</i></p>
@endif

@if (count($errors) > 0)

<div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert" style="float:right;">×</button>
    <strong>Whoops!</strong> There were some problems with your input.

    <ul>

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif
