@extends('include.page')

@section('content')

<div class="container">
    <h1>Login</h1>
</div>

<div class="container">

    @if (!session()->has('userLogin'))
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

    <br/><br/>
    <div id="return-msg" class="alert alert-warning" style="display:none">
        
    </div>
    @endif

    <div>
        <b-button v-b-modal.modal-1>Launch demo modal</b-button>
      
        <b-modal id="modal-1" title="BootstrapVue">
          <p class="my-4">Hello from modal!</p>
        </b-modal>
    </div>

</div>





@endsection

@section('script')

<script>

    $("#btnLogin").click(function (){
        let login= $("#login").val()
        let password= $("#password").val();
        let content= {"login": login, "password": password}
        let resp= null
        
        //console.log("chamou login...\n"+login+"\n"+password)

        //console.log(content)
        
        axios.post('authenticate', content)
            .then(function (response){
                this.resp= response.data
                
                if (!this.resp.error) {
                    window.location.href="http://localhost:8000/"
                } else {
                    $("#return-msg").html(this.resp.msg).show()
                }
                
            }).catch(function (error) {
                $("#return-msg").html(this.resp.msg).show()
            });

        event.preventDefault()
    })
</script>

@endsection


