@extends('include.page')

@section('content')

<div class="container">
    <h1>Produto <small>Cadastro</small></h1>
    <br/>

    <c-product-form-create
        p-type="{{ json_encode($type) }}"
        p-um="{{ json_encode($um) }}"
        p-category="{{ json_encode($category) }}"
    />

</div>

@endsection