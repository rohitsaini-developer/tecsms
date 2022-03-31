@extends('layouts.admin')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
<style>
    #phone_number{
        width: 544px;
    }
    .user-profile {
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 0px;
    }
</style>
@endsection


@section('content')

<div class="page-wrapper">

    <div class="content container-fluid">

        <!-- Start title-header section -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">{{ pageTitle() }}</h3>
                    <!-- [ breadcrumb ] start -->

                    @include('admin.partials.breadcrumb')

                    <!-- [ breadcrumb ] end -->
                </div>
            </div>
        </div>
        <!-- End title-header section -->


        <script>
                           
            @if(session()->has('success'))
                Swal.fire(
                    'Success!',
                    '{{ session()->get('success') }}',
                    'success'
                ).then(function() {
                    location.reload();
                });
            @endif

            @if(session()->has('error'))
                Swal.fire(
                    'Error!',
                    '{{ session()->get('error') }}',
                    'error'
                ).then(function() {
                    location.reload();
                });
            @endif
            
        </script>

        <script>
                @if(session()->has('image_success'))
                Swal.fire(
                    'Success!',
                    '{{ session()->get('image_success') }}',
                    'success'
                ).then(function() {
                    location.reload();
                });
            @endif

            @if(session()->has('image_error'))
                Swal.fire(
                    'Error!',
                    '{{ session()->get('image_error') }}',
                    'error'
                ).then(function() {
                    location.reload();
                });
            @endif

            @if(session()->has('profile_image'))
                Swal.fire(
                    'Error!',
                    '{{ session()->get('profile_image') }}',
                    'error'
                ).then(function() {
                    location.reload();
                });
            @endif
        </script>


        <!-- [ Main Content ] start -->
        <div class="row">

            <div class="col-md-9 order-md-2">

                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Profile details</h5>
                    </div>
                    <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">

                       {!! Form::open(['route'=>'update-profile', 'id' => 'admin-user-updateprofile-form']) !!}
                            <div class="form-group row">
                                {!! Form::label('Name', 'Name',['class'=>'col-sm-3 col-form-label font-weight-bolder']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('name', old('name', $user->name), ['class'=>'form-control','placeholder'=>'Enter Name']) !!}

                                    @error('name')
                                    <span class="invalid feedback text-danger" role="alert">
                                        {{ $message }}.
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                {!! Form::label('Email', 'Email',['class'=>'col-sm-3 col-form-label font-weight-bolder']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('email',old('email', $user->email), ['id'=>'Email','class'=>'form-control', 'readonly' => 'readonly']) !!}

                                    @error('email')
                                    <span class="invalid feedback text-danger" role="alert">
                                        {{ $message }}.
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('phone_number', 'Phone Number',['class'=>'col-sm-3 col-form-label font-weight-bolder']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('phone_number', old('phone_number', $user->phone_number), ['class'=>'form-control','placeholder'=>'Enter Phone Number','id'=>'phone_number']) !!}
                                    <input type="hidden" name="country_code" id="country_code">
                                    @error('phone_number')
                                    <span class="invalid feedback text-danger" role="alert">
                                        {{ $message }}.
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>

            </div>

            <div class="col-md-3 order-md-1">
                <div class="card user-profile user-card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Profile Image</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="">
                            <label class="avatar avatar-xxl profile-cover-avatar mt-1" for="edit_img">
                            <img id="avatarImg" class="avatar-img" src="@if(!empty($user->profile_image) && $user->profile_image !== 'default/user.svg') {{ asset('storage').'/'.$user->profile_image }}  @else {{ asset('storage/default/user.svg') }} @endif"  alt="User Image">

                            {!! Form::open(['route'=>'updateprofileimage','method'=>'post','id' => 'admin-user-updateprofileimage-form','enctype'=>'multipart/form-data']) !!}

                                {!! Form::file('profile_image',['class'=>'changeProfileImage','id'=>'edit_img']) !!}
                            {!! Form::close() !!}
                            <span class="avatar-edit">
                                <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                            </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- [ Main Content ] end -->

    </div>

</div>

@endsection



@section('scripts')
<!-- jquery-validation Js -->
<script src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

<script type="text/javascript">
'use strict';
$(document).ready(function() {

    $('#phone_number').mask('(999) 999-9999');


    $(function() {
        $('#admin-user-updateprofile-form').validate({
            ignore: '.ignore',
            focusInvalid: false,
            rules: {
                'name': {
                    required: true,
                },
                'email': {
                    required: true,
                    email: true
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

     $('body').on('change', '.changeProfileImage', function() {

        $('#profileImage').addClass('d-none');

        $('#profileLoader').removeClass('d-none');

        $('#admin-user-updateprofileimage-form').submit();

    });

     $('body').on('click', '.removeProfileImage', function() {

        $('#admin-user-removeprofileimage-form').submit();

    });


    var input = document.querySelector("#phone_number");
    var iti = window.intlTelInput(input, {
        separateDialCode: true,
        preferredCountries:["us"],
    });

    var countryData = iti.getSelectedCountryData();
    $('#country_code').val(countryData['iso2']+'-'+countryData['dialCode']);
    
    input.addEventListener("countrychange", function() {
    // do something with iti.getSelectedCountryData()
        var countryData = iti.getSelectedCountryData();
        $('#country_code').val(countryData['iso2']+'-'+countryData['dialCode']);
    });
    if('{{$user->country_code}}'){
       iti.setCountry("{{explode('-',$user->country_code)[0]}}");
    }
    
});

</script>
@endsection

