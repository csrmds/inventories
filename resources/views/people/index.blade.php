@extends('include.page')

@section('content')

<div class="container">
    <h1>Pessoas</h1>

    <div class="row">
        <div class="col-sm">
            campo de pesquisa de pessoas
        </div>
    </div>


    <br>
    <div class="row">
        <div class="col-sm">
            <table class="table table-striped table-sm">
                <thead>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Categoria</th>
                    <th>Cidate</th>
                    <th>Endereço</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($people as $ppl)
                    <tr>
                        <td>{{ $ppl->id }}</td>
                        <td>{{ $ppl->first_name }} {{ $ppl->last_name}}</td>
                        <td>{{ $ppl->type }}</td>
                        <td>{{ $ppl->category }}</td>
                        <td>{{ $ppl->city }}</td>
                        <td>{{ $ppl->address }}</td>
                        <td>Editar - Del</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>



@endsection