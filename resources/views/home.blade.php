@extends('include.page')

@section('content')

<div>
    <example-component></example-component>
</div>

<p>Parágro teste</p>

@endsection

@section('script')

<script>
    $(function(){
        console.log("eita brasil")
    })
</script>

@endsection

