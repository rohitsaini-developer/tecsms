<div class="row">
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-form-label col-md-4">Permission Name</label>
            <div class="col-md-8">
                {!! Form::text('name', old('name', isset($permission) ? $permission->name : ''), ['class'=>'form-control','placeholder'=>'Enter Permission Name', 'required'=>'true']) !!}
            </div>
            @error('name')
            <span class="invalid feedback text-danger" role="alert">
            {{ $message }}.
            </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-form-label col-md-4">Controller Name</label>
            <div class="col-md-8">
                {!! Form::text('controller_name', old('controller_name', isset($permission) ? $permission->controller_name : ''), ['class'=>'form-control','placeholder'=>'Enter Controller Name']) !!}
            </div>
            @error('controller_name')
            <span class="invalid feedback text-danger" role="alert">
            {{ $message }}.
            </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-form-label col-md-4">Function Name</label>
            <div class="col-md-8">
                {!! Form::text('function_name', old('function_name', isset($permission) ?$permission->function_name : ''), ['class'=>'form-control','placeholder'=>'Enter Function Name']) !!}
            </div>
            @error('function_name')
            <span class="invalid feedback text-danger" role="alert">
            {{ $message }}.
            </span>
            @enderror
        </div>
    </div>

    <div class="col-sm-6">

        <div class="form-group row">
            <label class="col-form-label col-md-4">Route Name</label>
            <div class="col-md-8">
                {!! Form::text('route_name', old('route_name', isset($permission) ? $permission->route_name : ''), ['class'=>'form-control','placeholder'=>'Enter Route Name']) !!}
            </div>
            @error('route_name')
            <span class="invalid feedback text-danger" role="alert">
            {{ $message }}.
            </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 text-right">
        {!! Form::submit(isset($permission) ? 'Update': 'Submit',['class'=>'btn btn-primary']) !!}
    </div>
</div>