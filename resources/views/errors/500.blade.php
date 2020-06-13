@extends('welcome')
@section('title', '500')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center p-4">
        <div class="col-md-7">
            <h2 class="mt-5 display-5 ml-2 text-center">500 Serverfout <img src="/images/sad.JPG" alt="sad face" width="50px" class="ml-3"></h2>
            <h1 class="mt-3 text-center">Sorry! Er is iets misgegaan.</h1>

            <div class="card mt-3">
                <div class="card-body text-center">
                   <p class="h5"> Dit ligt niet aan u maar aan ons en we zullen de fout zo snel mogelijk oplossen.</p>
                    <a class="btn btn-500 mt-2" href="/"> Ga naar de homepagina</a>
                    <a class="btn btn-outline-500 mt-2" href="/contact"> Neem contact op</a>
                   
                </div>
            </div>
                   
             
        </div>
    </div>
</div>
@endsection