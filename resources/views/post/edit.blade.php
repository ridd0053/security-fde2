@extends('layouts.app')
@section('title', 'Bewerk post')
@section('content')
<div class="container">
    <h3>Wijzig een post</h3>

<form action="/post/wijzigen/{{$post->id}}" method="post">
<input type="hidden" name="users[]" value="{{Auth::user()->id}}">
    @method('PATCH')
    @csrf
    
    @include("post.form")
      
        <button class="btn-post btn mt-2">Wijzig post</button>
    </div>
    </div>
    </form> 
</div> 
@stop

