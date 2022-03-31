@extends('layouts.admin')



@section('title','Update User')



@section('styles')

@endsection





@section('content')

<div class="page-wrapper">

    <div class="content container-fluid">
        <!-- Start title-header section -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Users</h3>
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



                        {!! Form::open(['route'=>['users.update', $user->id], 'method'=>'put' , 'id' => 'admin-user-edit-form']) !!}

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label class="col-form-label pt-0">User Name</label>
                                        <div class="">
                                            {!! Form::text('name', old('name',$user->name), ['class'=>'form-control','placeholder'=>'Enter Name']) !!}
                                        </div>
                                        @error('name')
                                        <span class="invalid feedback text-danger custm-right" role="alert">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                   </div>
                                </div>

                                <div class="col-sm-4">

                                    <div class="form-group row">
                                        <label class="col-form-label pt-0">User Email</label>
                                        <div class="">
                                         {!! Form::email('email', old('email',$user->email), ['class'=>'form-control','placeholder'=>'Enter Email']) !!}
                                        </div>
                                        @error('email')
                                        <span class="invalid feedback text-danger custm-right" role="alert">
                                        {{ $message }}
                                        </span>
                                        @enderror
                                   </div>
                                </div>

                                <!-- <div class="col-sm-12">

                                   <div class="form-group">

                                   {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Enter Password'])!!}

                                   </div>

                                   @error('password')

                                    <span class="invalid feedback text-danger" role="alert">

                                        {{ $message }}

                                    </span>

                                   @enderror

                                </div> -->

                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label class="col-form-label pt-0">Select Role</label>
                                        <div class="">
                                            {!!Form::select('roles', $roles, $user->roles->first()->id, ['class' => 'form-control','placeholder' => 'Select Role'])!!}
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

                                    {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}

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
            $('#admin-user-edit-form').validate({

                ignore: '.ignore',

                focusInvalid: false,

                rules: {

                    'name': {

                        required: true,

                    },
                    'email': {

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

</script>

@endsection

