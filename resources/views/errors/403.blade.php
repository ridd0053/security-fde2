@extends('welcome')
@section('title', '403')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center p-4">
        <div class="col-md-7">
            <h2 class="mt-5 display-5 ml-2 text-center">403 Authorisatie fout</h2>
           

            <div class="card mt-3">
                <div class="card-body text-center">
                   <p class="h5"> U bent niet toegestaan om deze handelingen te doen of u account is verbannen.</p>
                   <p > Vermoed u dat er iets niet klopt, neem dan contact op via de onderstaande knop.</p>
                    <a class="btn btn-500 mt-2" href="/"> Ga naar de homepagina</a>
                    <a class="btn btn-outline-500 mt-2" href="/contact"> Neem contact op</a>
                
                </div>
            </div>
                   
             
        </div>
    </div>
</div>
@endsection