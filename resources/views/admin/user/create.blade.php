@extends('layouts.admin')

@section('styles')

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

        <!-- [ Main Content ] start -->

        <div class="row justify-content-center">

            <div class="col-xl-12 d-flex">

                <div class="card">

                    <div class="card-body">

                        <script>

                           @if(session()->has('success'))
                               Swal.fire(
                                   'Success!',
                                   '{{ session()->get('success') }}',
                                   'success'
                               ).then(function() {
                                window.location.href="{{ route('users.index') }}";
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



                        {!! Form::open(['route'=>'users.store', 'id' => 'admin-user-add-form']) !!}

                            <div class="row">

                                <div class="col-sm-6">

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">User Name</label>
                                        <div class="col-md-8">
                                         {!! Form::text('name', old('name'), ['class'=>'form-control','placeholder'=>'Enter Name']) !!}
                                        </div>
                                        @error('name')
                                            <span class="invalid feedback text-danger custm-right" role="alert">
                                            {{ $message }}
                                            </span>
                                        @enderror
                                   </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">User Email</label>
                                        <div class="col-md-8">
                                         {!! Form::email('email', old('email'), ['class'=>'form-control','placeholder'=>'Enter Email']) !!}
                                        </div>
                                        @error('email')
                                            <span class="invalid feedback text-danger custm-right" role="alert">
                                            {{ $message }}
                                            </span>
                                        @enderror
                                   </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">User Password</label>
                                        <div class="col-md-8">
                                        {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Enter Password'])!!}
                                        </div>
                                        @error('password')
                                            <span class="invalid feedback text-danger custm-right" role="alert">
                                            {{ $message }}
                                            </span>
                                        @enderror
                                   </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Select Role</label>
                                        <div class="col-md-8">
                                         {!!Form::select('roles', $roles, null, ['class' => 'form-control','placeholder' => 'Select Role'])!!}
                                         </div>
                                        @error('roles')
                                        <span class="invalid feedback text-danger custm-right" role="alert">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}

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

        $('#admin-user-add-form').validate({

            ignore: '.ignore',

            focusInvalid: false,

            rules: {

                'name': {

                    required: true,

                },
                'email': {

                    required: true,

                },
                'password': {

                    required: true,

                },
                'roles': {

                    required: true,

                }

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

$(window).load(function() {
    $('#admin-user-add-form').get(0).reset(); //clear form data on page load
});

</script>

@endsection

