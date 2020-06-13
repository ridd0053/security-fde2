@extends('layouts.app')
@section('content')
@section('title', 'Post')
 <div class="container">
<article class="article column">

<h1 class="title col-md-6  mt-2 ">{{$post->title}}</h1>


<p class="col-md-6  mt-2 text-secondary">Laatst gewijzigd: {{date('d/m/Y', strtotime($post->updated_at))}}</p>
<small class=" col-md-6  mt-2 text-secondary">Schrijvers: 
@foreach ($post->users as $author)
@if(++$loop->index > 1)
|
@endif 
 {{$author->name}}
@endforeach
</small>
<div class="card shadow">
<p class="p-1 mt-2">{{$post->text}}</p>
</div>     
</article>

<a class="btn-primary btn mt-3 mb-3 my-sm-4" href="/post"> Terug naar overzicht</a>
@can('edit-posts' )
<a class=" btn-secondary btn " href="/post/wijzig/{{$post->id}}">Wijzig dit artikel</a>
@endcan
@can('delete-posts' )
<a id="removeButton" class="btn btn-danger" href="javascript:;" data-toggle="modal" onclick="deleteData({{$post->id}}, '{{$post->title}}')"
    data-target="#DeleteModal">Delete</a>
@endcan
</div>
@include('post.modalDelete')
  
@stop
<script type="text/javascript">
       function deleteData(id, title) {
            var id = id;
            var title = title
            $("#message").html(`<p >Weet u zeker dat u de post ${title} wilt verwijderen?</p> `);
            console.log(title)
            var url = '{{ route("post.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
</script>



