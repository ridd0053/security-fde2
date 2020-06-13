@extends('welcome')

@section('title', '404')


@section('content')

<div class="container ">
    <div class="row  d-inline-flex p-2 d-flex justify-content-center">
        <div class="col-md-8 ">
            <h1 class="mt-5 display-1 text-center">4 <img src="/images/crying_emoji.png" alt="sad emoji" width="100px"> 4 </h1>
            <h2 class="mt-2 display-5 text-center">Oeps! De pagina niet gevonden.</h2>

            <div class="card">
                <div class="card-body text-center">
                   <p class="h5"> Sorry maar de pagina die u probeert te bereiken bestaat niet, 
                       is verwijderd, is van naam veranderd of is tijdelijk niet bereikbaar.</p>
                    <a class="btn btn-404 mt-2 " href="/"> Ga naar de homepagina</a>
                    <a class="btn btn-outline-404 mt-2" href="/contact"> Neem contact op</a>
                   {{-- <p> Gebruik  de navigatiebalk om naar een nieuwe pagina te gaan of gebruik de onderstaande knop om terug te keren naar de homepagina.</p>
                   <p> Of gaan naar de homepagina om terug te keren naar het begin.</p> --}}
                </div>
            </div>
                   
              
        </div>
    </div>
</div>

@endsection