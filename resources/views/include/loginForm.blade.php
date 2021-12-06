<form action="{{ route('authenticate.login') }}" method="POST">
    @csrf
    
        <div class="form-row">
            <div class="col-sm">
                <label for="">Usuário</label>
                <input type="text" name="name" class="form-control form-control-sm">
            </div>
        </div>
    
        <div class="form-row">
            <div class="col-sm">
                <label for="">Senha</label>
                <input type="password" name="password" class="form-control form-control-sm">
            </div>
        </div>
        <br>
    
        <div class="form-row">
            <div class="col-sm">
                <button class="btn btn-sm btn-primary" type="submit">Login</button>
            </div>
            <div class="col-sm-2">
                <p><a href="{{ route('ldap.home') }}">LDAP Login</a></p>
            </div>
        </div>
    
    </form>
    
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