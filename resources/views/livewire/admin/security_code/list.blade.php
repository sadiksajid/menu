<div>

<style>
    .switch {
  position: absolute;
  display: inline-block;
  width: 90px;
  height: 36px;
  float:right;
  right: 14px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 6px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 34px;
  width: 32px;
  top: 1px;
  left: 1px;
  right: 1px;
  bottom: 1px;
  background-color: white;
  transition: 0.4s;
  border-radius: 6px;
}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(55px);
}

.slider:after {
  content:'OFF';
  color: white;
  display: block;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 50%;
  font-size: 10px;
  font-family: Verdana, sans-serif;
}
input:checked + .slider:after {
  content:'ON';
}
</style>
    <div class="row">
        <div class='col-12 mb-4'>
            <button class='btn btn-md btn-info' wire:click='addHeader'>
                {{ $translations['add_Profile'] }}
            </button>
            <div wire:loading class="spinner-border text-info ml-3" role="status"
                style="width: 30px;height: 30px;position: absolute;">
                <span class="sr-only">{{ $translations['loading'] }} ...</span>
            </div>
            <h4 style='position: absolute;float: right;right: 118px;top: 10px;'>Double Auth</h4>

            <label class="switch">
                <input type="checkbox" id="togBtn" wire:change='DoubleAuth' wire:model='double_auth' value='true'>
                <div class="slider"></div>
            </label>
        </div>
        @foreach($keys as $key => $value )
        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
        <div class="col-md-6 col-12">
            <div class="e-panel card">
                <div class="card-header">
                    <div class='col-4'>
                        <h3 class="card-title">{{ $translations['profile'] }} {{ $loop->index + 1 }}</h3>
                    </div>

                    <div class='col-8'>
                        @isset($status[$key])
                            @if($status[$key] == 1)
                                <button class='btn btn-danger ' style='float:right' wire:click="deleteProfile('{{$key}}')">
                                {{ $translations['desable'] }}</button>
                            @else
                                <button class='btn btn-success ' style='float:right' wire:click="EnableProfile('{{$key}}')">
                                {{ $translations['enable'] }}</button>
                            @endif
                        @else
                        <button class='btn btn-danger ' style='float:right' wire:click="deleteProfile('{{$key}}')">
                        {{ $translations['desable'] }}</button>
                        @endisset
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <label class="col-md-12 form-label">{{ $translations['full_name'] }} <span
                                    class="text-red">*</span></label>
                            <input class="form-control mb-4" placeholder="{{ $translations['full_name'] }}" type="text"
                                wire:model='fullname.{{$key}}'>
                            @error('fullname.'.$key)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="col-md-12 form-label">{{ $translations['role'] }} <span
                                    class="text-red">*</span></label>
                            <select class="form-control select2 custom-select"
                                data-placeholder="{{ $translations['select_role'] }}"
                                wire:model.defer='profile_role.{{$key}}'>
                                <option label="{{ $translations['select_role'] }}">
                                </option>
                                @foreach($roles as $role)
                                <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>

                            @error('profile_role.'.$key)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        @if($value == 'old')
                            <div class="col-6 mt-2">
                                <label class="col-md-12 form-label">{{ $translations['old_password'] }}<span
                                        class="text-red">*</span></label>
                                <input class="form-control mb-4" placeholder="{{ $translations['old_password'] }}"
                                    type="password" wire:model.defer='old_password.{{$key}}'>
                                @error('old_password.'.$key)
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        <div class="col-6 mt-2">
                            <label class="col-md-12 form-label">{{ $translations['password'] }}<span
                                    class="text-red">*</span></label>
                            <input class="form-control mb-4" placeholder="{{ $translations['password'] }}"
                                type="password" wire:model.defer='password.{{$key}}'>
                            @error('password.'.$key)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button class='btn btn-primary' wire:click="Update('{{$key}}')">
                                Save <strong>{{ $fullname[$key] ?? ''}}</strong>
                            </button>

                            @isset($pdfs[$key])
                            <a href="{{$pdfs[$key]}}" target="_blank" >
                                <button class='btn btn-primary float-right'>
                                    Download Card
                                </button>
                            </a>
                            @endisset
                        </div>
                    </div>




                </div>
            </div>
        </div>
        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
        @endforeach


    </div>

</div>