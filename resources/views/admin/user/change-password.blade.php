@extends('layouts.admin')



@section('title','Change Password')



@section('styles')
<style>
.user-profile {
    margin-top: 0px;
    margin-left: 0px;
    margin-right: 0px;
}
.remove-error-img{
    background-image: none !important;
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
                    <h3 class="page-title">Change Password</h3>
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

        <!-- [ Main Content ] start -->

        <div class="row">

            <div class="col-md-12 order-md-2">

                <div class="card">
                     
                    <script>
                           
                           @if(session()->has('password-success'))
                               Swal.fire(
                                   'Success!',
                                   '{{ session()->get('password-success') }}',
                                   'success'
                               ).then(function() {
                                   location.reload();
                               });
                           @endif

                           @if(session()->has('password-error'))
                               Swal.fire(
                                   'Error!',
                                   '{{ session()->get('password-error') }}',
                                   'error'
                               ).then(function() {
                                   location.reload();
                               });
                           @endif
                           
                       </script>
                    <div class="card-body border-top collapse show">
                        {!! Form::open(['route'=>'update-password', 'id' => 'admin-user-updatepassword-form']) !!}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    {!! Form::label('Old Password', 'Old Password',['class'=>'col-sm-4 col-form-label font-weight-bolder']) !!}
                                    <div class="col-sm-8">
                                        <div class="pass-group">
                                            {!! Form::password('oldpassword',['id'=>'old-password','class'=>'form-control pass-input remove-error-img']) !!}
                                            <span class="fas fa-eye toggle-password"></span>
                                        </div>
                                        @error('oldpassword')
                                        <span class="invalid feedback text-danger" role="alert">
                                            {{ $message }}.
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-12">
                            <div class="form-group row">
                                {!! Form::label('New Password', 'New Password',['class'=>'col-sm-4 col-form-label font-weight-bolder']) !!}
                                <div class="col-sm-8">
                                    <div class="pass-group">
                                        {!! Form::password('newpassword',['id'=>'new-password','class'=>'form-control pass-input remove-error-img']) !!}
                                        <span class="fas fa-eye toggle-password"></span>
                                    </div>
                                    @error('newpassword')
                                    <span class="invalid feedback text-danger" role="alert">
                                        {{ $message }}.
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12">
                            <div class="form-group row">
                                {!! Form::label('Confirm Password', 'Confirm Password',['class'=>'col-sm-4 col-form-label font-weight-bolder']) !!}
                                <div class="col-sm-8">
                                    <div class="pass-group">
                                        {!! Form::password('newpassword_confirmation',['id'=>'confirm-password','class'=>'form-control pass-input remove-error-img']) !!}
                                        <span class="fas fa-eye toggle-password"></span>
                                    </div>
                                    @error('newpassword_confirmation')
                                    <span class="invalid feedback text-danger" role="alert">
                                        {{ $message }}.
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12 text-right">
                            <div class="form-group row mb-0">
                                <div class="col-sm-12">
                                    {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
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

<script type="text/javascript">
'use strict';
$(document).ready(function() {

    $(function() {

        $('#admin-user-updatepassword-form').validate({
            ignore: '.ignore',
            focusInvalid: false,
            rules: {
                'oldpassword': {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                'newpassword': {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                'newpassword_confirmation': {
                    required: true,
                    minlength: 6,
                    equalTo: 'input[name="newpassword"]'
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
@endsection

