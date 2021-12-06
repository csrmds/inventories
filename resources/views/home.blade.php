@extends('include.page')

@section('content')

<div class="container">
    <h1>Login</h1>

    @if (Auth::check() || Auth::guard('ldapusers')->check())
        <p>Redirecionando...</p>
        <script>window.location='/people'</script>
        
    @else
        @include('include.loginForm')    
    @endif

    

</div>


@endsection

@section('script')

<script>
</script>

@endsection