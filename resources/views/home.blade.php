@extends('layouts.app')

@section('content')
@section('title', 'Profiel')
@if (\Session::has('successMessage'))
<div class="alert alert-success alert-dismissible mt-2">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{\Session::get('successMessage')}}
</div>
@endif

<div class="container my-5">
    <div class="row justify-content-start">
        <div class="col-md-4">
            <div class="card justify-content-center">
            <div class="card-header font-weight-bold text-center">{{Auth::user()->name}}</div>
                <div class="card-body ">
                    <img class="img-thumbnail card-img-top" src="images/avatar/{{Auth::user()->avatar}}" alt="profiel foto {{Auth::user()->name}}">
                    <hr>
          
                    <div class="text-center mt-2"> 
                        @can('delete-own-account')
                        <a id="removeButton" class="btn btn-danger" href="javascript:;" data-toggle="modal" onclick="deleteData({{Auth::user()->id}})"
                        data-target="#DeleteModal">Verwijder je account</a>
                        @endcan
                    </div>
                  
                </div>
            </div>
        </div>
        @include('modalDelete')
    
        
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Gebruikers informatie</div>
                    <div class="card-body">
                        <p> <span class="font-weight-bold">Naam:</span> {{Auth::user()->name}}</p>
                        <p> <span class="font-weight-bold">E-mail:</span> {{Auth::user()->email}}</p>
                        <p> <span class="font-weight-bold">Rol:</span>
                        @foreach(Auth::user()->roles()->get()->pluck('name') as $roleName)
                                @if(++$loop->index > 1)
                                |
                                @endif 
                                {{$roleName}}
                           
                        @endforeach  
                        </p>
                        <hr>
                        <h6>Wijzig je profielfoto</h6>
                        <form enctype="multipart/form-data" action="{{route('updateAvatar')}}" method="post">
                            <div class="form-group">
                                <input type="file" class="form-control" name="avatar">
                                <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update profielfoto</button>
                        </form>
                        <hr>
                        <hr>
                        <h6>Verander je profiel gegevens</h6>
                        <hr>
                        <form action="{{ route('update', Auth::user()->id) }}" method="post">
                            @csrf()
                            {{method_field('PATCH')}}
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-left">Email</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-left">Naam</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}"  autocomplete="name">
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-left">Selecteer je rol</label>
                            @foreach($roles as $role)
                                @if(Auth::user()->isAdmin() AND Auth::user()->countAdmin() > 1)
                                
                                <div class="form-check">
                                
                                <input type="checkbox" name="roles[]" value="{{$role->id}}" 
                                                     
                                @if(Auth::user()->roles()->get()->contains($role->id)) checked="checked" @endif
                                >
                                <label for="roles[]">{{$role->name}}</label>
                                
                         
                            </div>
                            
                            @elseif(Auth::user()->isAdmin() AND Auth::user()->countAdmin() === 1)
                      
                            <div class="form-check">
                               
                                <input type="hidden" name="roles[]" value="1">
                                @unless($role->name === "admin")
                                   <input type="checkbox" name="roles[]" value="{{$role->id}}"                      
                                    @if(Auth::user()->roles()->get()->contains($role->id)) checked="checked" @endif
                                        >
                                    <label for="roles[]">{{$role->name}}</label>
                                @endunless
                                
                         
                            </div>
                            @endif
                            @endforeach
                            @cannot('edit-own-role')
                               
                                @foreach(Auth::user()->roles as $ownRole)
                                <input type="hidden" name="roles[]" value="{{$ownRole->id}}">
                                @endforeach
                            
                            @endcan
                            
                            <button type="submit" class="btn btn-primary">Update</button> 
                        </form>
                        <hr>
                        <h6>Wijzig uw wachtwoord</h6>
                        <hr>
                     
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible mt-2">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                           Uw wachtwoord kan niet gewijzigd worden.
                        </div>
                        @endif
                        @if (\Session::has('error'))
                        <div class="alert alert-danger alert-dismissible mt-2">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{\Session::get('error')}}
                        </div>
                        @endif
                        <form  action="{{route('changePassword')}}" method="post">
                            @csrf()
                            <div class="form-group pr-5">
                                <label for="current_password">Huidig wachtwoord</label>
                                <input type="password" class="form-control" name="current_password" id="current_password">
                               
                              
                            </div>
                            <div class="form-group pr-5">
                                <label for="new_password">Nieuw wachtwoord</label>
                                <input type="password" class="form-control" name="new_password" id="new_password">
                             
                            </div>
                            <div class="form-group pr-5">
                                <label for="new_password_confirmation">Bevestig wachtwoord</label>
                                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation">
                             
                            </div>
                            <button type="submit" class="btn btn-primary">Wijzig wachtwoord</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
   
</div>
<script type="text/javascript">
    function deleteData(id) {
        var id = id;
        var url = '{{ route("destroyAccount", ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
        

    }

    function formSubmit() {
        $("#deleteForm").submit();
    }

</script>


@endsection
