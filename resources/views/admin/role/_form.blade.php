<div class="row">

    <div class="col-sm-12">

        <div class="form-group row">
            <label class="col-form-label col-md-2">Role Name</label>
            <div class="col-md-10">
            {!! Form::text('name', old('name', isset($role) ? $role->name : ''), ['class'=>'form-control','placeholder'=>'Enter Role Name']) !!}
            </div>
            @error('name')
            <span class="invalid feedback text-danger custm-right" role="alert">
            {{ $message }}.
            </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group row">
            <label class="col-form-label">Select Permission</label>
            @if(!empty($permissions_array))
                @foreach($permissions_array as $groups=>$val )
                    <h6>{{Str::ucfirst($groups)}}</h6>
                    @foreach($val as $x=>$permission)
                        @php  $check = ""; @endphp
                        @if(isset($selected_permission))
                            @if (in_array($x, $selected_permission))
                                @php  $check = "checked"; @endphp
                            @endif
                        @endif
                        <div class="col-md-3 ">
                        <div class="checkbox-btn-custm">
                            <input type="checkbox" {{$check}}  name="permissions[]" value="{{$x}}">
                            
                            <label for="vehicle1">{{$permission}}</label> 
                        </div>
                        </div>
                    @endforeach
                @endforeach
            @endif
        @error('permissions')
        <span class="invalid feedback text-danger custm-right" role="alert">
        {{ $message }}.
        </span>
        @enderror
        </div>
    </div>
    <div class="col-sm-12">
        {!! Form::submit(isset($role) ? 'Update' : 'Submit',['class'=>'btn btn-primary']) !!}
    </div>
</div>