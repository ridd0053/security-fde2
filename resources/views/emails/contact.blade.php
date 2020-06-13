@component('mail::message')
#Bericht gekregen

<strong>E-mail adres</strong> {{$data['email']}}

<strong>Onderwerp</strong> {{$data['subject']}}

<strong>Bericht</strong>

{{$data['message']}}

@endcomponent
