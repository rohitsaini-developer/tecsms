@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(auth()->user()->email_verified_at === null)
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        {{-- action="{{ route('verification.resend.email') }}" --}}
                        <form class="d-inline" method="POST" >
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            @endif
            @if(auth()->user()->phone_number_verified_at === null)
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Phone Number') }}</div>
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your Phone Number.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your phone number for a verification link.') }}
                        {{ __('If you did not receive the SMS') }},
                        {{-- action="{{ route('verification.resend.phone') }}" --}}
                        <form class="d-inline" method="POST" > 
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
