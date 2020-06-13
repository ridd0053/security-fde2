@extends('welcome')
@section('title', 'contactpagina')
@section('content')
<div class="container">
    <div  class="col-md-4 pt-3">
    <h1 class="text-left text-dark">Contact pagina</h1>
    </div>
<div class=" p-3">
            @if (\Session::has('succesMessage'))
                <div class="alert alert-success alert-dismissible mt-2">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{\Session::get('succesMessage')}}
                </div>
            @endif
            <form action="/contact" method="POST" class="col-md-10">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible mt-2">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               Het contactformulier kan niet verzonden worden.
            </div>
            @endif
           <div class="form-group required  @error('email') error  @enderror">
              <label for="email" class="control-label col-form-label">Uw e-mailadres</label>
              <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"  value="{{old('email')}}">
            </div>
            @error('email')
            <div class="text-danger mb-2">{{ $message }}</div>
            @enderror
            <div class="form-group required  @error('subject') error  @enderror">
                <label class="control-label col-form-label" for="subject">Onderwerp</label>
                <input name="subject" type="text" class="form-control @error('subject') is-invalid @enderror"  placeholder="Geef een onderwerp"  value="{{old('subject')}}" >
            </div>
            @error('subject')
            <div class="text-danger mb-2">{{ $message }}</div>
            @enderror
            <div class="form-group required  @error('subject') error  @enderror">
                <label class="control-label col-form-label" for="message">Plaats uw bericht</label>
            <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="exampleFormControlTextarea1" rows="4"  >{{old('message')}}</textarea>
            </div>
            @error('message')
            <div class="text-danger mb-2">{{ $message }}</div>
            @enderror
            @csrf
            <div >
                <small class="ml-2 text-">* verplicht</small>
            </div>
            <button type="submit" class="btn-contact btn mt-2">Verzend bericht</button>
        
        </form>
   
</div>
</div>

@endsection