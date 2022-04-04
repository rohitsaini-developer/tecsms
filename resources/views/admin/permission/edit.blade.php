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




                        {!! Form::open(['route'=>['admin.permissions.update', $permission->id], 'method'=>'put', 'id' => 'admin-permission-edit-form']) !!}
                            <!-- include files -->
                            @include('admin.permission._form')

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
            $('#admin-permission-edit-form').validate({
                ignore: '.ignore',
                focusInvalid: false,
                rules: {
                    'name': {
                        required: true,
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
                     console.log($el);
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

