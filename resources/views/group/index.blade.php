@extends('include.page')

@section('content')


<div class="container">
    <h1>Grupos</h1>

    <div class="row">
        <div class="col-sm">
            <c-group-search></c-group-search>
        </div>
        <div class="col-sm-1">
            <a href="#">
                <button class="btn btn-secondary">NOVO</button>
            </a>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm">
            <c-group-table-list></c-group-table-list>
            {{-- <table class="table table-striped table-sm">
                <thead>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Gr Pai</th>
                    <th>Tabela</th>
                    <th>-</th>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                    <tr>
                        <td>{{ $group->hierarchy }}</td>
                        <td>{{ $group->table }}</td>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->description }}</td>
                        <td>Edit</td>
                    </tr>
                    @endforeach
                </tbody>
            </table> --}}
            
        </div>
    </div>

</div>
<br/>

<div class="row">
    
</div>


@endsection