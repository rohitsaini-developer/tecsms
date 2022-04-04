@extends('layouts.admin')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
    <style>
        .iti {
            width: 100%;
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
                    {{--@include('admin.partials.breadcrumb')--}}
                    <!-- [ breadcrumb ] end -->
                </div>
            </div>
        </div>
        <!-- End title-header section -->

        <!-- [ Main Content ] start -->

        <div class="row justify-content-center">

            <div class="col-xl-12">

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



                        {!! Form::open(['route'=>'admin.users.store', 'id' => 'admin-user-add-form']) !!}

                            @include('admin.user.partials._form')

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

@include('admin.user.partials._script')

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

