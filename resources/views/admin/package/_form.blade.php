<div class="row">

    <div class="col-sm-8">
        <div class="form-group">
            <label class="col-form-label">Name</label>
            <div class="col-md-10">
                {!! Form::text('name', old('name', isset($package) ? $package->name : ''), ['class'=>'form-control','placeholder'=>'Enter Name', 'required' => 'true']) !!}
            </div>
            @error('name')
                <span class="invalid feedback text-danger custm-right" role="alert">{{ $message }}.</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group ">
            <label class="col-form-label">Price</label>
            <div class="col-md-10">
                {!! Form::text('price', old('price', isset($package) ? $package->price : ''), ['class'=>'form-control','placeholder'=>'Enter Price','required' => 'true', 'step'=>"0.01", 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
            </div>
            @error('price')
                <span class="invalid feedback text-danger custm-right" role="alert">{{ $message }}.</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group ">
            <label class="col-form-label">Sale Price</label>
            <div class="col-md-10">
                {!! Form::text('sale_price', old('sale_price', isset($package) ? $package->sale_price : ''), ['class'=>'form-control','placeholder'=>'Enter Sale Price','step'=>"0.01", 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"]) !!}
            </div>
            @error('sale_price')
                <span class="invalid feedback text-danger custm-right" role="alert">{{ $message }}.</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group ">
            <label class="col-form-label">Validity ( In Days )</label>
            <div class="col-md-10">
                {!! Form::text('validity', old('validity', isset($package) ? $package->validity : ''), ['class'=>'form-control','required' => 'true','placeholder'=>'Enter Validity', 'oninput'=>"this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'onkeypress' => 'return /[0-9a-zA-Z]/i.test(event.key);']) !!}
            </div>
            @error('validity')
                <span class="invalid feedback text-danger custm-right" role="alert">{{ $message }}.</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group ">
            <label class="col-form-label">Description</label>
            <div class="col-md-10">
                {!! Form::textarea('description', old('description', isset($package) ? $package->description : ''), ['class'=>'form-control','placeholder'=>'Enter Description']) !!}
            </div>
            @error('description')
                <span class="invalid feedback text-danger custm-right" role="alert">{{ $message }}.</span>
            @enderror
        </div>
    </div>
    <div class="col-sm-8">
        {!! Form::submit(isset($package) ? 'Update' : 'Submit',['class'=>'btn btn-primary']) !!}
    </div>
</div>