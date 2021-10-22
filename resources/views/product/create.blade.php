@extends('include.page')

@section('content')

<div class="container">
    <h1>Produto <small>Cadastro</small></h1>
    <br/>

    <c-product-form-create
        type="{{ json_encode($type) }}"
        um="{{ json_encode($um) }}"
    />

</div>

@endsection