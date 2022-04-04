@extends('layouts.admin')
@section('styles')
<!-- data tables css -->
<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">  
 <style>
    .iti {
        width: 100%;
    }
    .key-header {
        padding: 10px 15px;
        background: #e7e7e7;
    }
 </style>
@endsection
@section('content')
   
    <script>
        @if(session()->has('success'))
            Swal.fire(
                'Success!',
                '{{ session()->get('success') }}',
                'success'
            ).then(function() {

                window.location.href="{{ route('admin.settings.change') }}";
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


<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- [ Main Content ] start -->

         <!-- Start title-header section -->
         <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Settings</h3>
                    <!-- [ breadcrumb ] start -->

                    {{--@include('admin.partials.breadcrumb')--}}

                    <!-- [ breadcrumb ] end -->
                </div>
            </div>
        </div>
        <!-- End title-header section -->
        <div class="row">

            <div class="col-sm-12 p-0">
                <div class="content container-fluid">
                    <div class="row">
                        <div class="card bg-white px-0">
                            <div class="card-body">
                                {!! Form::open(['route'=>['admin.settings.updateChange'], 'method'=>'post', 'id' => 'setting-change-form', 'enctype' => 'multipart/form-data']) !!}
                                @csrf

                                <input type="hidden" class="form-control" name="active_tab" value="" id="last_tab">
                                <input type ="hidden" class="setval" value="" name="setval">

                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                    @php $i = 0; @endphp
                                    @if(!empty($settings))
                                        @foreach($settings as $group_key => $setting)
                                            <li class="nav-item">
                                                <a class="nav-link has-ripple {{ ($i == 0) ? 'active' : '' }}"  id="{{ $group_key }}-tab" href="#tabs-{{ $group_key }}" data-bs-toggle="tab" role="tab" data-active="{{ $group_key }}">{{ ucfirst(Str::replaceArray('_', [' '], $group_key)) }}</a>
                                            </li>
                                            @php
                                            $i++;
                                            @endphp
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="tab-content">
                                    @php
                                    $j = 0;



                                    $paypalCount = 1;
                                    $googleCount = 1;
                                    $twilioCount = 1;
                                    $facebookCount = 1;
                                    @endphp
                                   
                                    @foreach($settings as $group => $group_settings)
                                    <div class="tab-pane show <?php if($j==0) { echo "active";} ?>" id="tabs-{{$group}}">
                                        <div class="row">
                                            @foreach($group_settings as $setting)
                                            @php 
                                            $errorname = $group.'.'.$setting->key;
                                            @endphp
                                            
                                            @if(strpos($setting->key, 'paypal') !== false && $setting->key !='paypal_email')
                                                @if($paypalCount ==1)
                                                    <div class="key-header">
                                                        <h5 class="mb-0">Paypal</h5 class="mb-0">
                                                    </div>
                                                @endif
                                                @php $paypalCount++ @endphp
                                            @endif
                                            @if(strpos($setting->key, 'google') !== false)
                                                @if($googleCount ==1)
                                                    <div class="key-header">
                                                        <h5 class="mb-0">Google</h5 class="mb-0">
                                                    </div>
                                                @endif
                                                @php $googleCount++ @endphp
                                            @endif
                                            @if(strpos($setting->key, 'twilio') !== false)
                                                @if($twilioCount ==1)
                                                    <div class="key-header">
                                                        <h5 class="mb-0">Twilio</h5 class="mb-0">
                                                    </div>
                                                @endif
                                                @php $twilioCount++ @endphp
                                            @endif
                                            @if(strpos($setting->key, 'facebook') !== false && $setting->key !='facebook_url')
                                                @if($facebookCount ==1)
                                                    <div class="key-header">
                                                        <h5 class="mb-0">Facebook</h5 class="mb-0">
                                                    </div>
                                                @endif
                                                @php $facebookCount++ @endphp
                                            @endif
                                            <div class="col-sm-6">
                                                <div class="form-group {{ $errors->has($setting->key) ? ' has-error' : '' }} align-items-center">
                                                    @if($setting->status == 'publish')
                                                       <label class="col-form-label col-md-4">{{ $setting->display_name }}</label>
                                                    @endif
                                        
                                                    @if ($setting->type == "text")
                                                    <div class="col-md-11 ">
                                                      @if($setting->key == 'phone_number')
                                                        @php
                                                        $phone_number_value ='';
                                                        $country_code  ='';
                                                        $phone = explode('-',$setting->value);
                                                        if(isset($phone) && !empty($phone)){
                                                            if( isset($phone[1]) ){
                                                                $phone_number_value = $phone[1]; 
                                                            }
                                                        }

                                                        if(isset($phone[0])){
                                                            $country_code = str_replace('+','',$phone[0]);
                                                        }
                                                        @endphp
                                                         <input type="hidden" name="country_code" id="country_code" value="{{$country_code}}" data-number="{{$phone_number_value}}">
                                                         
                                                         <input type="text" class="form-control" placeholder="{{ $setting->display_name }}"  name="{{$group}}[{{ $setting->key }}]" id="{{ $setting->key }}" value="{{str_replace('+','',$phone_number_value)}}" {{ ($setting->group == 'social' || $setting->group == 'footer') ? '' : '' }}>
                                                        @else
                                                         <input type="text" class="form-control" placeholder="{{ $setting->display_name }}"  name="{{$group}}[{{ $setting->key }}]" id="{{ $setting->key }}" value="{{ $setting->value }}" {{ ($setting->group == 'social' || $setting->group == 'footer') ? '' : '' }}>
                                                      @endif
                                                    
                                                    </div>
                                                    @if($errors->has($errorname))
                                                        <p class="help-block text-danger custm-right">
                                                            {{ $errors->first($errorname) }}
                                                        </p>
                                                    @endif
                                                    @elseif($setting->type == "email")
                                                    <div class="col-md-11">
                                                    <input type="email" class="form-control" placeholder="{{ $setting->display_name }}" required name="{{$group}}[{{ $setting->key }}]" id="{{ $setting->key }}" value="{{ $setting->value }}" {{ ($setting->group == 'social' || $setting->group == 'footer') ? '' : '' }}">
                                                    </div>
                                                    @if($errors->has($errorname))
                                                        <p class="help-block text-danger custm-right">
                                                            {{ $errors->first($errorname) }}
                                                        </p>
                                                    @endif

                                                    @elseif($setting->type == "number")
                                                    <div class="col-md-11">
                                                    <input type="number" required class="form-control" name="{{$group}}[{{ $setting->key }}]" placeholder="{{$setting->display_name}}" value="{{ $setting->value }}" min="0" >
                                                    </div>
                                                    @if($errors->has($errorname))
                                                        <p class="help-block text-danger custm-right">
                                                            {{ $errors->first($errorname) }}
                                                        </p>
                                                    @endif

                                                    @elseif($setting->type == "text_area")
                                                    <div class="col-md-11">
                                                    <textarea style="margin-bottom:10px;" class="form-control" required placeholder="{{$setting->display_name}}" name="{{$group}}[{{ $setting->key }}]" >{{ $setting->value ?? '' }}</textarea>
                                                    </div>
                                                    @if($errors->has($errorname))
                                                        <p class="help-block text-danger custm-right">
                                                            {{ $errors->first($errorname) }}
                                                        </p>
                                                    @endif

                                                    @elseif($setting->type == "image" && $setting->status == 'publish')
                                                    <div class="">
                                                        
                                                    </div> 
                                                    <div class="col-md-12 row">
                                                        <div class="col-sm-6">
                                                            <input class="form-control" type="file" name="{{$group}}[{{ $setting->key }}]">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            
                                                            <img src="{{ asset($setting->value) }}" class="{{$setting->key}}" style="width:100px;height:auto;padding: 10px;border:1px solid #ddd;">
                                                        </div>
                                                    </div>
                                                    @if($errors->has($errorname))
                                                        <p class="help-block text-danger custm-right">
                                                            {{ $errors->first($errorname) }}
                                                        </p>
                                                    @endif
                                                    
                                                       

                                                    <div class="clearfix"></div>
                                                    @elseif(isset($setting->value))

                                                        @if(json_decode($setting->value) !== null)

                                                            @foreach(json_decode($setting->value) as $file)

                                                            <div class="fileType">
                                                                <a class="fileType" target="_blank" href="{{ Storage::disk('public')->url($file->download_link) }}">
                                                                    {{ $file->original_name }}
                                                                </a>
                                                                
                                                            </div>
                                                            @endforeach

                                                            @elseif($setting->type == "image" && $setting->status == 'publish')
                                                            <div class="col-sm-3">
                                                                
                                                            </div>
                                                           
                                                            <div class="col-sm-3">
                                                                
                                                                <img src="{{ Storage::disk('public')->url($setting->value) }}" class="{{$setting->key}}" style="width:100px;height:auto;padding: 10px;border:1px solid #ddd;background: #000;">
                                                            </div>
                                                            @if($errors->has($errorname))
                                                                <p class="help-block text-danger custm-right">
                                                                    {{ $errors->first($errorname) }}
                                                                </p>
                                                            @endif

                                                        @endif

                                                    @endif
                                                    @if($setting->type == "dropdown")

                                                    <?php $options = json_decode($setting->details); ?>

                                                    <?php $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL; ?>
                                                    <select class="form-control" required name="{{ $setting->key }}">
                                                        @php $default = (isset($options->default)) ? $options->default : NULL; @endphp
                                                        @if(isset($options->options))
                                                        @foreach($options->options as $index => $option)
                                                        <option value="{{ $index }}" @if($default==$index && $selected_value===NULL) selected="selected" @endif @if($selected_value==$index) selected="selected" @endif>{{ $option }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>

                                                    @if($errors->has($errorname))
                                                        <p class="help-block text-danger custm-right">
                                                            {{ $errors->first($errorname) }}
                                                        </p>
                                                    @endif

                                                    @elseif($setting->type == "radio_btn")

                                                    @php
                                                        $options = json_decode($setting->details);
                                                        $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL;
                                                        $default = (isset($options->default)) ? $options->default : NULL;
                                                    @endphp

                                                    @if(isset($options->options))
                                                    @foreach($options->options as $index => $option)
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="option-{{ $index }}" class="custom-control-input" required name="{{$group}}[{{ $setting->key }}]" value="{{ $index }}" @if($default==$index && $selected_value===NULL) checked @endif @if($selected_value==$index) checked @endif>
                                                        <label class="custom-control-label" for="option-{{ $index }}">{{ $option }}</label>
                                                    </div>
                                                    @endforeach
                                                    @if($errors->has($errorname))
                                                        <p class="help-block text-danger custm-right">
                                                            {{ $errors->first($errorname) }}
                                                        </p>
                                                    @endif
                                                    @endif

                                                    @elseif($setting->type == "checkbox")

                                                    @php
                                                    $options = json_decode($setting->details);
                                                    $checked_values = explode(',', $setting->value);
                                                    @endphp

                                                    @if(isset($options->options))
                                                    @foreach($options->options as $index => $option)
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="{{$group}}[{{ $setting->key }}][]" value="{{ $index }}" id="option-{{ $index }}" class="custom-control-input" @if(in_array($index, $checked_values)) checked @endif>
                                                        <label class="custom-control-label" for="option-{{ $index }}">{{ $option }}</label>
                                                    </div>
                                                    @endforeach

                                                    @foreach($errors as $error)
                                                        @if($errors->has($errorname))
                                                        <p class="help-block text-danger custm-right">
                                                            {{ $errors->first($errorname) }}
                                                        </p>
                                                    @endif
                                                    @endforeach

                                                    @endif


                                                    @endif


                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-sm-12">
                                                {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
                                            </div>

                                        </div>
                                    </div>
                                        @php
                                        $j++;
                                        @endphp
                                    @endforeach
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

<!-- datatable Js -->

<script src="{{ URL::asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
<!-- jquery-validation Js -->

<script src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"> </script>  

<script type="text/javascript">

'use strict';
$(document).ready(function() {
//    $('#phone_number').mask();  
   
   changeCurrencyFlag('+'+$('#country_code').val()+$('#country_code').data('number'));
});
</script>
<script type="text/javascript">

'use strict';

$(document).ready(function() {
    checkvalidation();
    $(function() {
        $('#setting-change-form').validate({
            ignore: ":hidden",
            focusInvalid: false,

            rules: {
                field: {
                    required: true,
                    email: true,
                    text: true,
                    number:true,
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

function changeCurrencyFlag(flagcode){
    $('.iti__selected-flag').remove();
    // $('#phone_number').mask('(999) 999-9999');

    var input = document.querySelector("#phone_number");
    var iti = window.intlTelInput(input, {
        separateDialCode: true,
        preferredCountries:['in','us'],
        initialCountry: "us",
    });
   
    iti.setNumber(flagcode);
    var countryData = iti.getSelectedCountryData();
    // console.log(countryData);
    $('#country_code').val(countryData['dialCode']);
    
    input.addEventListener("countrychange", function() {
    // do something with iti.getSelectedCountryData()
        var countryData = iti.getSelectedCountryData();
        $('#country_code').val(countryData['dialCode']);
    });

    
}
</script>
@endsection


