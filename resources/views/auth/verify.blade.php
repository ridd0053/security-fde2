@extends('layouts.app')
@section('title', 'Verifiëren')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8  mt-3">
            <div class="card">
                <div class="card-header">{{ __('Verifieer uw account') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Een verificatie mail is naar uw e-mail verzonden.') }}
                        </div>
                    @endif

                    {{ __('Voordat u verder kan, verifieer eerst uw account in de gestuurde verificatie e-mail.') }}
                    {{ __('Heeft u geen mail ontvangen?') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Klik hier voor een andere verificatie e-mail.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
