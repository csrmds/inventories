@extends('include.page')

@section('content')

<div class="container">
    <h1>Configurações</h1>

    <div class="form-row">
        <div class="col-sm">
            <h3>OCS Server</h3>
            <c-config-ocs-form-create/>
        </div>
    </div>
    <hr>

    <div class="form-row">
        <div class="col-sm">
            <h3>DC Server</h3>
            <c-config-dc-form-create/>
        </div>
    </div>
    <hr>

</div>



@endsection