
 <div class="col-sm-12">
    <div class="form-group row {{ $errors->has('group') ? 'has-error' : '' }}">
        <label class="col-form-label col-md-3" for="group">Group*</label>
        <div class="col-md-9">
            <select class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group" id="group" required>
            <option selected disabled>Select Group</option>
            @foreach($groups as $group)
            <option value="{{ $group->group }}" {{ old('group', isset($setting) && $setting->group == $group->group) ? 'selected' : '' }}>{{ ucwords($group->group) }}</option>
            @endforeach
            </select>
        </div>
        @if($errors->has('group'))
        <p class="help-block text-danger custm-right">
            {{ $errors->first('group') }}
        </p>
        @endif
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group row {{ $errors->has('type') ? 'has-error' : '' }}">
        <label  class="col-form-label col-md-3" for="type">Type*</label>
        <div class="col-md-9">
            <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type"  required>
                <option selected disabled>Select Type</option>
                @foreach($settingTypes as $key => $settingType)
                <option value="{{ $key }}" {{ old('type', isset($setting) && $setting->type == $key) ? 'selected' : '' }}>{{ ucwords($settingType) }}</option>
                @endforeach
            </select>
            </div>
        @if($errors->has('type'))
        <p class="help-block text-danger custm-right">
            {{ $errors->first('type') }}
        </p>
        @endif
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group row {{ $errors->has('key') ? 'has-error' : '' }}">
        <label class="col-form-label col-md-3" for="key">Key*</label>
            <div class="col-md-9">
                <input type="text" id="key" name="key" class="form-control" value="{{ old('key', isset($setting) ? $setting->key : '') }}" placeholder="Enter the key" required>
                @if($errors->has('key'))
                <p class="help-block text-danger custm-right">
                    {{ $errors->first('key') }}
                </p>
                @endif
            </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group row {{ $errors->has('value') ? 'has-error' : '' }}">
        <label class="col-form-label col-md-3" for="value">Value*</label>
        <div class="col-md-9">
            <input type="text" id="value" name="value" class="form-control" value="{{ old('value', isset($setting) ? $setting->value : '') }}" placeholder="Enter the value" required>
            @if($errors->has('value'))
            <p class="help-block text-danger custm-right">
                {{ $errors->first('value') }}
            </p>
            @endif
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="form-group row {{ $errors->has('display_name') ? 'has-error' : '' }}">
        <label class="col-form-label col-md-3" for="display_name">Display Name*</label>
        <div class="col-md-9">
            <input type="text" id="display_name" name="display_name" class="form-control" value="{{ old('display_name', isset($setting) ? $setting->display_name : '') }}" placeholder="Enter the display name" required>
                @if($errors->has('display_name'))
                <p class="help-block text-danger custm-right">
                    {{ $errors->first('display_name') }}
                </p>
                @endif
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="form-group row{{ $errors->has('tag') ? 'has-error' : '' }}">
        <label for="tag" class="col-form-label col-md-3">Tag*</label>
        <div class="col-md-9">
            <input type="text" id="tag" name="tag" class="form-control" value="{{ old('tag', isset($setting) ? $setting->tag : '') }}" placeholder="Enter realted tag / category name" >
            @if($errors->has('tag'))
            <p class="help-block text-danger custm-right">
                {{ $errors->first('tag') }}
            </p>
            @endif
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group row {{ $errors->has('details') ? 'has-error' : '' }}">
        <label for="details" class="col-form-label col-md-3">Detais</label>
        <div class="col-md-9">
            <textarea id="details" name="details" rows="10" cols="50" class="form-control" placeholder="Enter the json format for dropdown/radio btn/ checkbox" required>{{ old('details', isset($setting) ? $setting->details : '')  }}</textarea>
        </div>
        @if($errors->has('details'))
        <p class="help-block text-danger custm-right">
            {{ $errors->first('details') }}
        </p>
         @endif
    </div>
</div>

<div class="col-sm-12">
    <div class="form-group row">
    <label for="status" class="col-md-3">Status</label>
    <label class='toggle-label col-md-9'>
        <input type="checkbox" name="status" value="1"  @if(old('status') || isset($setting) && $setting->status == 'publish') checked @endif>
        <span class="back">
                <span class="toggle"></span>
                <span class="label on">Publish</span>  
                <!-- <span class="label off">Unpublish</span> -->
            </span>
    </label>
    </div>
</div>

<div>
    <input class="btn btn-primary pull-right" type="submit" value="Submit">
</div>

