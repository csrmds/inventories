@extends('include.page')

@section('content')

<div class="container">
    <h1>Teste</h1>

    <br>
    <form>
    <div class="row">
        <div class="col-sm">
            
            <c-teste value="cesar melo">
            
        </div>
    </div>

    </form>


</div>

@endsection

@section('script')

<script>

$("#submit").click( ()=> {
    event.preventDefault()
    console.log("eita...")
})

</script>

@endsection