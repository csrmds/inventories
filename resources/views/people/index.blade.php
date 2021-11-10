@extends('include.page')

@section('content')

<div class="container">
    <h1>Pessoas</h1>

    <div class="row">
        <div class="col-sm">
            <c-people-table-list></c-people-table-list>
        </div>
    </div>

</div>



@endsection