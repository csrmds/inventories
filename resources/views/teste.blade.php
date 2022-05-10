@extends('include.page')

@section('content')

<?php
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\People;






?>

<div class="container">
    <h1>TESTE</h1>

<?php

echo "<pre>";

print_r($_SERVER);







echo "</pre>";

// $teste= system('dir', $retval);

// echo "<pre>
// Linha: $teste <br/>
// valor: $retval <br/>
// </pre>";

?>

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