@extends('include.page')

@section('content')

<div class="container">
    <h1>Produtos</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <c-product-find></c-product-find>
        </div>
        <div>
            <a href="{{ route('product.create') }}">
                <button class="btn btn-secondary">Novo</button>
            </a>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm">
            <table class="table table-striped table-sm">
                <thead>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>-</th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>{{ $product->model }}</td>
                        <td>
                            Edit
                            Del
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection