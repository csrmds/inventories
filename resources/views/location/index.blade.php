@extends('include.page')

@section('content')

<div class="container">
    <h1>Localizações / Depositos</h1>

    <div class="row">
        <div class="col-sm">
            {{ print_r($location) }}
        </div>
    </div>

</div>



@endsection