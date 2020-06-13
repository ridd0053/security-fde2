@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user->name}}</div>
            
                <div class="card-body">
                    <form action="{{ route('user.users.update', $user->id) }}" method="post">
                        @csrf()
                        {{method_field('PUT')}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        @foreach($roles as $role)
                            @if($user->isAdmin() AND $user->countAdmin() > 1)
                        <div class="form-check">
                           
                            <input type="checkbox" name="roles[]" value="{{$role->id}}"                      
                            @if($user->roles()->get()->contains($role->id)) checked="checked" @endif
                            >
                            <label for="roles[]">{{$role->name}}</label>
                            
                     
                        </div>
                        
                        @elseif($user->isAdmin() AND $user->countAdmin() === 1)
                        <div class="form-check">
                           
                            <input type="hidden" name="roles[]" value="1">
                            @unless($role->name === "admin")
                               <input type="checkbox" name="roles[]" value="{{$role->id}}"                      
                                @if($user->roles()->get()->contains($role->id)) checked="checked" @endif
                                    >
                                <label for="roles[]">{{$role->name}}</label>
                            @endunless
                            
                     
                        </div>
                        @endif
                        @endforeach
                        @cannot('edit-own-role')
                           
                            @foreach($user->roles as $ownRole)
                            <input type="hidden" name="roles[]" value="{{$ownRole->id}}">
                            @endforeach
                        
                        @endcan
                        <a type="button" href="{{ route('user.users.index') }}" class="btn btn-secondary">Terug naar overzicht</a>
                        <button type="submit" class="btn btn-primary">Update</button> 
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

