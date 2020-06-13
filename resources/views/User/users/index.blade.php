@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (\Session::has('successMsg'))
            <div class="alert alert-success alert-dismissible mt-2">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{\Session::get('successMsg')}}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{$user->name}}</div>
                <table class="table">
                    <thead>
                        <tr>
                            
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Roles</th>
                            
                            <th scope="col">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                
                
                        <tr>
                       
                            <td>{{$user->name}} </td>
                            <td>{{$user->email}}</td>
                            <td> 
                             @foreach($user->roles()->get()->pluck('name') as $roleName)
                                @if(++$loop->index > 1)
                                |
                                @endif 
                                {{$roleName}}
                           
                            @endforeach  
                            
                            </td>
                                               
                                                     
                            <td>
                                
                                
                                    <a href="{{ route('user.users.edit', $user->id) }}"> <button type="button" class="btn btn-primary">Edit</button> </a>
                             
                                    @can('delete-own-account')
                                    <a id="removeButton" class="btn btn-danger" href="javascript:;" data-toggle="modal" onclick="deleteData({{Auth::user()->id}})"
                                    data-target="#DeleteModal">Delete</a>
                                    @endcan
                             
                            </td>
                        </tr>
                    
                   
                
                @include('user.users.modalDelete')
                    </tbody>
                </table>
                <div class="card-body">
      
            </div>
        </div>
    </div>
</div>
<script>
          function deleteData(id) {
            var id = id;
            var url = '{{ route("user.users.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
            

        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
</script>
@endsection
