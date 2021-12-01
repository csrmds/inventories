@extends('include.page')

@section('content')

<div class="container">
    <h1>Login</h1>
</div>

<div class="container">

    <c-login-form></c-login-form>

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


