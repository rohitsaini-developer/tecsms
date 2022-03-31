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
                                window.location.href="{{ route('roles.index') }}";
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



                        {!! Form::open(['route'=>'roles.store', 'id' => 'admin-role-add-form']) !!}

                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            {!! Form::text('name', old('name'), ['class'=>'form-control','placeholder'=>'Please enter a role name .........']) !!}
                                        </div>
                                   </div>
                                   @error('name')
                                    <span class="invalid feedback text-danger" role="alert">
                                        {{ $message }}.
                                    </span>
                                   @enderror
                                </div>

                                <hr/>

                                <div class="col-sm-12">

                                    <div class="form-group row">
                                        <label class="col-form-label">Choose Permissions</label>
                                        @if(!empty($permissions_array))
                                            @foreach($permissions_array as $groups=>$val )
                                                <h6>{{Str::ucfirst($groups)}}</h6>
                                                @foreach($val as $x=>$permission)
                                                    <div class="col-md-3">
                                                        <div class="checkbox-btn-custm">
                                                            <input type="checkbox"  name="permissions[]" value="{{$x}}"> 
                                                            <label for="vehicle1">{{$permission}}</label> 
                                                        </div>
                                                    </div>

                                                @endforeach
                                            @endforeach
                                        @endif
                                        @error('permissions_array')
                                        <span class="invalid feedback text-danger" role="alert">
                                        {{ $message }}.
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">

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

        $('#admin-role-add-form').validate({

            ignore: '.ignore',

            focusInvalid: false,

            rules: {

                'name': {

                    required: true,

                },

                'permissions[]': {

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

