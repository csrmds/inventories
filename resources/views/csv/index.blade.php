@extends('include.page')

@section('content')

<div class="container">
    <h1>Importação arquivos CSV</h1>

    <div class="row">
        <div class="col-sm">
            <c-csv-table-products></c-csv-table-products>
        </div>
    </div>
    <br>


    <!-- <div class="row">
        <div class="col-sm">
            <table class="table table-sm table-striped">
                <thead>
                    <td>#</td>
                    <th>tipo</th>
                    <th>Marca</th>
                    <th>Patrimônio</th>
                    <th>Localização ID</th>
                    <th>Localização</th>
                    <th>Numero de série</th>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $loop->index}}</td>
                            <td>{{ $record['TIPO'] }}</td>
                            <td>{{ $record['MARCA'] }}</td>
                            <td>{{ $record['PATRIMONIO'] }}</td>
                            <td>{{ $record['LOCALIZAÇÃO ID'] }}</td>
                            <td>{{ $record['LOCALIZAÇÃO'] }}</td>
                            <td>{{ $record['NUMERO DE SÉRIE'] }}</td>
                        </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> -->

</div>



@endsection