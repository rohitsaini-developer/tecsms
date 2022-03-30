@extends('layouts.app')

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
                            
                            <div class="col-md-6 row">
                                <div class="col-md-4">
                                    <select name="phone_country_id" id="country_id" class="form-control @error('phone_country_id') is-invalid @enderror">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}"> +{{ $country->phonecode }} {{ $country->sortname }} </option>
                                        @endforeach
                                    </select>
                                    @error('phone_country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-8 ">
                                    <input id="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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
        });
    </script>
@endsection