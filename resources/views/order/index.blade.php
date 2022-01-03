@extends('include.page')

@section('content')

<div class="container">
    <h1>Pedidos de movimentação</h1>

    <div class="form-row">
        <div class="col-sm">
            <c-order-form-local
                location-list="{{ json_encode($locations) }}"
            />
        </div>
    </div>

</div>



@endsection