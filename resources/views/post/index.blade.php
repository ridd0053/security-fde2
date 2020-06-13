@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (\Session::has('successMessage'))
                <div class="alert alert-success alert-dismissible mt-2">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{\Session::get('successMessage')}}
                </div>
            @endif
            @can('create-posts')
            <a href="/post/aanmaken" class="btn btn-success my-2">Maak post</a>
            @endcan
                  @foreach($posts as $post)
                  <div class="card mt-4 mb-5">
                    <div class="card-header">
                        Post @if(++$loop->index > 0){{$loop->index}}@endif 
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                         <p class="card-text">{{$post->text}}</p>
                         @can('see-posts')
                        <a href="/post/{{$post->id}}" class="btn btn-primary">Bekijk de hele post</a>
                        @endcan
                        @can('edit-posts')
                        <a href="/post/wijzig/{{$post->id}}" class="btn btn-secondary">Wijzig de post</a>
                        @endcan
                      
                        @can('delete-posts')
                        <a id="removeButton" class="btn btn-danger" href="javascript:;" data-toggle="modal" onclick="deleteData({{$post->id}}, '{{$post->title}}')"
                            data-target="#DeleteModal">Delete</a>
                        @endcan
                    
                    
                    </div>
                </div>
                   
                @endforeach
            </div>
        </div>
                @include('post.modalDelete')
              
   
<script type="text/javascript">
        function deleteData(id, title) {
            var id = id;
            var title = title
            $("#message").html(`<p>Weet u zeker dat u de post ${title} wilt verwijderen?</p> `);
            console.log(title)
            var url = '{{ route("post.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
            
            

        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
 
    </script>
@endsection
