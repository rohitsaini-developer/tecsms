<div class="col-sm-6">
    <div class="form-group">
    {!! Form::label('email', 'Name') !!}
        <div class="">
            {!! Form::text('name', old('name', isset($postpaidUser) ? $postpaidUser->name : ''), ['class'=>'form-control','placeholder'=>'Enter Name']) !!}
        </div>
        @error('name')
        <span class="invalid feedback text-danger custm-right" role="alert">
        {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        <div class="">
            {!! Form::email('email', old('email',isset($postpaidUser) ? $postpaidUser->email : ''), ['class'=>'form-control','placeholder'=>'Enter Email']) !!}
        </div>
        @error('email')
        <span class="invalid feedback text-danger custm-right" role="alert">
        {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('phone_number', 'Phone Number') !!}
            {!! Form::hidden('country_code', isset($countryCode) ? $countryCode : null, ['class'=>'form-control', 'id' => 'country_code']) !!}

            {!! Form::text('phone_number', old('phone_number', isset($postpaidUser) ? $postpaidUser->phone_number : ''), ['class'=>'form-control', 'id' => 'phone_number','placeholder'=>'Enter Phome Number', 'required' => 'true']) !!}
            @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>
</div> 
{{-- <div class="col-sm-6">
    <div class="form-group">
    {!! Form::label('billing_id', 'Billing Id') !!}
        <div class="">
            {!! Form::text('billing_id', old('billing_id', isset($postpaidUser) ? $postpaidUser->billing_id : ''), ['class'=>'form-control','placeholder'=>'Enter Billing Id']) !!}
        </div>
        @error('billing_id')
        <span class="invalid feedback text-danger custm-right" role="alert">
        {{ $message }}
        </span>
        @enderror
    </div>
</div>--}}
@if(!isset($postpaidUser))
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        <div class="">
            {!!Form::password('password', ['class'=>'form-control','placeholder'=>'Enter Password'])!!}
        </div>
        @error('password')
            <span class="invalid feedback text-danger custm-right" role="alert">
            {{ $message }}
            </span>
        @enderror
    </div>
</div>
@endif
<div class="col-sm-12 text-right">
    {!! Form::submit(isset($postpaidUser) ? 'Update' : 'Submit',['class'=>'btn btn-primary']) !!}
</div>
