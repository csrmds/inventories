@extends('include.page')

@section('content')

<?php
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\People;

?>

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

    <pre>
        <?php
            $people= People::Find('110');

            $user= $people-getUser();
            

            
        ?>
    </pre>


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