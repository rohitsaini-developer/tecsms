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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <script>
                           @if(session()->has('success'))
                               Swal.fire(
                                   'Success!',
                                   '{{ session()->get('success') }}',
                                   'success'
                               ).then(function() {
                                window.location.href="{{ route('permissions.index') }}";
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

                        
                        {!! Form::open(['route'=>'permissions.store', 'id' => 'admin-permission-add-form']) !!}

                            <div class="row">

                                <div class="col-sm-6">

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Permission Name</label>
                                        <div class="col-md-8">
                                            {!! Form::text('name', old('name'), ['class'=>'form-control','placeholder'=>'Enter Permission Name']) !!}
                                        </div>
                                    @error('name')
                                    <span class="invalid feedback text-danger" role="alert">
                                    {{ $message }}
                                    </span>
                                    @enderror
                                   </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Controller Name</label>
                                        <div class="col-md-8">
                                            {!! Form::text('controller_name', old('controller_name'), ['class'=>'form-control','placeholder'=>'Enter Controller Name']) !!}
                                        </div>
                                   </div>

                                   @error('controller_name')

                                        <span class="invalid feedback text-danger" role="alert">

                                        {{ $message }}

                                        </span>

                                        @enderror 
                                   </div>
                            

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Function Name</label>
                                        <div class="col-md-8">
                                            {!! Form::text('function_name', old('function_name'), ['class'=>'form-control','placeholder'=>'Enter Function Name']) !!}
                                        </div>
                                        @error('function_name')
                                        <span class="invalid feedback text-danger" role="alert">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                   </div>
                                   
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Route Name</label>
                                        <div class="col-md-8">
                                            {!! Form::text('route_name', old('route_name'), ['class'=>'form-control','placeholder'=>'Enter Route Name']) !!}
                                        </div>
                                        @error('route_name')
                                        <span class="invalid feedback text-danger" role="alert">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                   </div>
                                </div>

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

    $('#admin-permission-add-form').validate({

        ignore: '.ignore',

        focusInvalid: false,

        rules: {

            'name': {

                required: true,

            },
            'controller_name': {

                required: true,

            },
            'function_name': {

                required: true,

            },
            'route_name': {

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

</script>

@endsection

