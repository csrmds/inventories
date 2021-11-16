@extends('include.page')

@section('content')

<div class="container">
    <h1>Locais / Depósitos / Estoques</h1>

    <div class="form-row">
        <div class="col-sm">
            <c-location-table-list></c-location-table-list>
        </div>
    </div>

</div>



@endsection