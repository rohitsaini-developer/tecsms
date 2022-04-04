@extends('layouts.app')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
    <style>
        .iti {
            width: 100%;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Social Login User') }}</div>

                <div class="card-body">
                    <form method="POST" id="social-login-form">
                        @csrf
                        <input type="hidden" name="name" value="{{ $userData['name'] }}">
                        <input type="hidden" name="email" value="{{ $userData['email'] }}">
                        <input type="hidden" name="social_login_id" value="{{ $userData['social_login_id'] }}">
                        <input type="hidden" name="register_type" value="{{ $userData['register_type'] }}">

                        <div class="row mb-3">
                            <h5 for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</h5>
                            <p class="col-md-4 col-form-label">{{ $userData['name'] }}</p>
                        </div>

                        <div class="row mb-3">
                            <h5 for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</h5>
                            <p class="col-md-4 col-form-label">{{ $userData['email'] }}</p>
                        </div>
                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>
                            
                            <div class="col-md-6">
                                <input type="hidden" name="country_code" id="country_code" value="">
                                                         
                                <input type="text" class="form-control" placeholder="Phone Number"  name="phone_number" id="phone_number" value="">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script>
        $(document).ready(function(e){
            $("#social-login-form").on("submit", function(e){
                e.preventDefault();
                $('.validation-error-block').remove();
                var formData = $(this).serialize();

                $.ajax({
                    type: 'post',
                    url: "{{route('auth.social-register')}}",
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect_url;
                        }
                    },
                    error: function(response) {
                        var errorLabelTitle = '';
                        $.each(response.responseJSON.errors, function(key, item) {
                            errorLabelTitle = '<span class="validation-error-block">' + item + '</sapn>';
                            console.log(key);
                            $(errorLabelTitle).insertAfter("input[name='" + key + "']");
                            $(errorLabelTitle).insertAfter("select[name='" + key + "']");
                        });
                    }
                });
            });
            changeCurrencyFlag('+1');
        });

        function changeCurrencyFlag(flagcode){
            $('.iti__selected-flag').remove();
            // $('#phone_number').mask('(999) 999-9999');

            var input = document.querySelector("#phone_number");
            var iti = window.intlTelInput(input, {
                separateDialCode: true,
                preferredCountries:['in','us'],
                initialCountry: "us",
            });
        
            iti.setNumber(flagcode);
            var countryData = iti.getSelectedCountryData();
            // console.log(countryData);
            $('#country_code').val(countryData['dialCode']);
            
            input.addEventListener("countrychange", function() {
            // do something with iti.getSelectedCountryData()
                var countryData = iti.getSelectedCountryData();
                $('#country_code').val(countryData['dialCode']);
            });
        }
        
    </script>
@endsection