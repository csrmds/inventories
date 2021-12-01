@extends('include.page')

@section('content')

<div class="container">
    <h1>LDAP Login</h1>

<form action="{{ route('ldap.login') }}" method="POST" enctype="multipart/form-data">
@csrf

    <div class="form-row">
        <div class="col-sm">
            <label for="">LDAP User</label>
            <input type="text" class="form-control form-control-sm" name="name" >
        </div>
    </div>

    <div class="form-row">
        <div class="col-sm">
            <label for="">Senha</label>
            <input type="password" class="form-control form-control-sm" name="password" >
        </div>
    </div>
    <br>

    <div class="form-row">
        <div class="col-sm">
            <button class="btn btn-sm btn-primary" type="submit" >LOGIN</button>
        </div>
        <div class="col-sm-2">
            <p><a href="{{ route('/') }}">Normal Login</a></p>
        </div>
    </div>
    <br>

    @if (session('loginError'))
    <div class="row">
        <div class="col-sm">
            <div class="alert alert-warning alert-dismissible" role="alert">
                {{ session('loginError') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

</div>

</form>

@endsection