<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="" />
        <meta name="keywords" content="">
        <meta name="author" content="Phoenixcoded" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} | Login</title>

        <link rel="shortcut icon" href="#">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       
        <style>
            .remove-error-img{
                background-image: none !important;
            }
        </style>
    </head>
<body>
<script>
    @if(session()->has('status'))
        Swal.fire(
            'Success!',
            '{{ session()->get('status') }}',
            'success'
        ).then(function() {
            location.reload();
        });
    @endif
</script>
<!-- [ auth-signin ] start -->
<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <img class="img-fluid logo-dark mb-2" src="{{ asset('img/logo.png') }}" alt="Logo">
          
            <div class="loginbox">
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Login</h1>
                        <p class="account-subtitle">Access to our dashboard</p>
                        {!! Form::open(['route'=>'login', 'id' => 'admin-login-form']) !!}
                            <div class="form-group">
                                {!! Form::label('Email', 'Email',['class'=>'form-control-label']) !!}
                                {!! Form::text('email',old('email'),['id'=>'Email','class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Password', 'Password',['class'=>'form-control-label']) !!}
                                <div class="pass-group">
                                    {!! Form::password('password',['id'=>'Password','class'=>'form-control pass-input remove-error-img']) !!}
                                    <span class="fas fa-eye toggle-password"></span>
                                </div>
                            </div>
                            @error('email')
                            <span class="invalid feedback text-danger" role="alert">
                                {{ $message }}.
                            </span>
                            @enderror
                            @error('password')
                            <span class="invalid feedback text-danger" role="alert">
                                {{ $message }}.
                            </span>
                            @enderror
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="custom-control checkbox-btn-custm">
                                            {!! Form::checkbox('remember', 'true', false, ['id' => 'customCheck1', 'class' => 'custom-control-input']) !!}
                                            {!! Form::label('customCheck1', 'Remember me',['class'=>'custom-control-label']) !!}
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 text-end fg-pass">
                                        @if (Route::has('password.request'))
                                        <a class="forgot-link" href="{{ route('password.request') }}">Forgot Password ?</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {!! Form::submit('Login', ['id' => '', 'class' => 'btn btn-lg btn-block btn-primary w-100']) !!}
                            {!! Form::close() !!} 
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signin ] end -->


<!-- Required Js -->
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/feather.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

<!-- jquery-validation Js -->
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
'use strict';
$(document).ready(function() {
    $(function() {
        $('#admin-login-form').validate({
            ignore: '.ignore',
            focusInvalid: false,
            rules: {
                'email': {
                    required: true,
                    email: true
                },
                'password': {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
            },

            // Errors //
            errorPlacement: function errorPlacement(error, element) {
                var $parent = $(element).parents('.form-group');

                // Do not duplicate errors
                if ($parent.find('.jquery-validation-error').length) {
                    return;
                }

                $parent.append(
                    error.addClass('jquery-validation-error small form-text invalid-feedback')
                );
            },
            highlight: function(element) {
                var $el = $(element);
                var $parent = $el.parents('.form-group');

                $el.addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
            }
        });
    });
});
</script>
</body>
</html>
