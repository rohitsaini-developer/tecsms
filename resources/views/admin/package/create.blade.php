@extends('layouts.admin')


@section('styles')

<!-- select2 css -->

<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
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
            <div class="col-xl-12 d-flex role-edit-box">
                <div class="card flex-fill">
                    <div class="card-body">
                    <script>
                           @if(session()->has('success'))
                               Swal.fire(
                                   'Success!',
                                   '{{ session()->get('success') }}',
                                   'success'
                               ).then(function() {
                                window.location.href="{{ route('admin.packages.index') }}";
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



                        {!! Form::open(['route'=>'admin.packages.store', 'id' => 'admin-package-add-form']) !!}

                            @include('admin.package._form')

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

<!-- select2 Js -->
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>





<script type="text/javascript">

'use strict';

$(document).ready(function() {

    $('.select2box').select2({

        placeholder: "Select permissions",

        allowClear: true

    });



    $(function() {

        $('#admin-package-add-form').validate({

            ignore: '.ignore',

            focusInvalid: false,

            rules: {

                'name': {
                    required: true,
                },
                'price': {
                    required: true,
                },
                'validity': {
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

