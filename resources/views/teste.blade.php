@extends('include.page')

@section('content')

<div class="container">
    <h1>Teste</h1>

    <br>
    <form>
    <div class="row">
        <div class="col-sm">
            
                <input type="text" class="form-control form-control-sm">
            
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
            <button id="submit" type="submit" class="btn btn-sm btn-outline-primary">submit</button>
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