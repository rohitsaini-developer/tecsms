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

        <div class="row">

            <div class="col-sm-12 p-0">

                <div class="card">

                    <div class="card-body">

                        <script>
                           
                           @if(session()->has('success'))
                               Swal.fire(
                                   'Success!',
                                   '{{ session()->get('success') }}',
                                   'success'
                               ).then(function() {
                                window.location.href="{{ route('settings.index') }}";
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
                        <form action="{{ route('settings.update', [$setting->id]) }}" method="POST" id="admin-setting-edit-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('admin.settings.partials._form')
                        </form>
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

        $('#admin-setting-edit-form').validate({

        ignore: '.ignore',

        focusInvalid: false,

        rules: {

            'group': {

                required: true,

            },

            'type': {

                required: true,

            },
            'key': {

                required: true,

            },

            'value': {

                required: true,

            },
            'display_name': {

                required: true,

            },

            'tag': {

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

</script>

@endsection

