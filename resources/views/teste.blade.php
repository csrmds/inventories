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

    <div class="row">
        <div class="col-sm">
            <table class="table table-striped table-sm">
                <tbody>
                    @foreach ($people as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->first_name." ".$p->last_name }}</td>
                        <td>{{ $p->cpf }}</td>
                        <td>{{ $p->category }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>


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