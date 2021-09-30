@extends('include.page')

@section('content')

<div class="container">
    <h1>Login</h1>
</div>

<div class="container">
    <form>
        <div class="form-group">
            <label>Email</label>
            <input 
                type="text" 
                name="login"
                id="login"
                class="form-control input-sm" 
                placeholder="Email de login" 
                required>
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input 
                type="password"
                name="password" 
                id="password"
                class="form-control input-sm" 
                required>
        </div>

        <button type="submit" class="btn btn-primary" id="btnLogin">Login</button>
    </form>

    <div id="return-msg">
        
    </div>
</div>





@endsection

@section('script')

<script>

    $("#btnLogin").click(function (){
        let login= $("#login").val()
        let password= $("#password").val();
        let content= {"login": login, "password": password}
        
        //console.log("chamou login...\n"+login+"\n"+password)

        //console.log(content)
        
        axios.post('authenticate', content)
            .then(function (response){
                console.log(response.data)
            }).catch(function (error) {
                console.log(error)
            });


        event.preventDefault()
    })
</script>

@endsection


