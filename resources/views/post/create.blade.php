@extends('layouts.app')
@section('title', 'Maak post aan')
@section('content')
<div class="container">
    <h3>Maak een post</h3>
    <form action="/post" method="post" class="col-md-10">
    @csrf
    @include("post.form")
    <button class="btn-post btn mt-2 ">Voeg post toe</button>
</div>
</div>
    
    </form>
</div>  
@stop


