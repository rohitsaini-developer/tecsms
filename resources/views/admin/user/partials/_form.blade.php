<div class="col-sm-6">
    <div class="form-group">
    {!! Form::label('email', 'Name') !!}
        <div class="">
            {!! Form::text('name', old('name', isset($user) ? $user->name : ''), ['class'=>'form-control','placeholder'=>'Enter Name']) !!}
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
            {!! Form::email('email', old('email',isset($user) ? $user->email : ''), ['class'=>'form-control','placeholder'=>'Enter Email']) !!}
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
        <div class="col-md-12 row">
            <div class="col-md-4">
                {!!Form::select('phone_country_id', $countries, isset($user) ? $user->phone_country_id : '', ['class' => 'form-control select2'])!!}
                @error('phone_country_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-8 ">
                {!! Form::text('phone_number', old('phone_number', isset($user) ? $user->phone_number : ''), ['class'=>'form-control','placeholder'=>'Enter Phome Number', 'required' => 'true']) !!}
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>

@if(!isset($user))
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
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('roles', 'Select Role') !!}
        <div class="">
            {!!Form::select('roles', $roles, isset($user) ? $user->roles->first()->id : '', ['class' => 'form-control select2','placeholder' => 'Select Role'])!!}
        </div>
        @error('roles')
        <span class="invalid feedback text-danger custm-right" role="alert">
        {{ $message }}
        </span>
        @enderror
    </div>
</div>
<div class="col-sm-12 text-right">
    {!! Form::submit(isset($user) ? 'Update' : 'Submit',['class'=>'btn btn-primary']) !!}
</div>
