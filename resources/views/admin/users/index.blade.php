@extends('layouts.app')
@section('title', 'Gebruikers management')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            @if (\Session::has('successMessage'))
                <div class="alert alert-success alert-dismissible mt-2">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{\Session::get('successMessage')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Users</div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Roles</th>
                            @if(Gate::check('edit-users') || Gate::check('delete-users'))
                            <th scope="col">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                Dit ben jij:
                            </th>
                            <td>{{Auth::user()->name}} </td>
                            <td>{{Auth::user()->email}}</td>
                            <td> 
                             @foreach(Auth::user()->roles()->get()->pluck('name') as $roleName)
                                @if(++$loop->index > 1)
                                |
                                @endif 
                                {{$roleName}}
                            @endforeach  
                            {{-- <!-- {{ implode(',', $user->roles()->get()->pluck('name')->toArray()) }} --> --}}
                            </td>
                            <td>
                                
                            @can('edit-own-role')
                                <a href="{{ route('home', Auth::user()->id) }}"> <button type="button" class="btn btn-primary">Edit</button> </a>
                            @endcan
                            @cannot('edit-own-role')
                            <a href="{{ route('home', Auth::user()->id) }}"> <button type="button" class="btn btn-primary">Edit</button> </a>
                            @endcan
                           
                                
                            </td>
                        </tr>
            
                        
                @foreach($users as $user)
                        <tr>
                            <th scope="row">
                            @if(++$loop->index > 0)
                                {{$loop->index}}
                            @endif 
                            </th>
                            <td>{{$user->name}} </td>
                            <td>{{$user->email}}</td>
                            <td> 
                             @foreach($user->roles()->get()->pluck('name') as $roleName)
                                @if(++$loop->index > 1)
                                |
                                @endif 
                                {{$roleName}}
                            @endforeach  
                            {{-- <!-- {{ implode(',', $user->roles()->get()->pluck('name')->toArray()) }} --> --}}
                            </td>
                            <td>
                                
                                @can('edit-users')
                                    <a href="{{ route('admin.users.edit', $user->id) }}"> <button type="button" class="btn btn-primary">Edit</button> </a>
                               @endcan
                               @can('delete-users' )
                               
                                    <a id="removeButton" class="btn btn-danger" href="javascript:;" data-toggle="modal" onclick="deleteData({{$user->id}})"
                                    data-target="#DeleteModal">Delete</a>
                                @endcan
                            </td>
                        </tr>
                   
                @endforeach
                @include('admin.users.modalDelete')
                    </tbody>
                </table>
                <div class="card-body">
      
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{ route("admin.users.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
            

        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
 
    </script>
@endsection
