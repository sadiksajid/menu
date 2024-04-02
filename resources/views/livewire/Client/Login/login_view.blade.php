<div>
  {{-- <div style="    position: fixed;
  width: 500px;
  min-height: 100px;
  z-index: 10000;
  top: 0px;
  margin-right: auto;`
  margin-left: auto;
  left: 0;
  right: 0;
  ">
        <div wire:loading.class.remove="d-none"
        class="spinner-border text-secondary d-none" role="status"
        style="    font-size: 11px;
        width: 25px;
        height: 25px;">
            <span class="sr-only">Loading...</span>
    </div>

  </div> --}}
  <div wire:ignore class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 10000">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" aria-label="Close"
            id='closeLogin'>
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">

          <div class="md-form mb-3">
            <i class="fas fa-envelope prefix grey-text"></i>
            <input type="email" " placeholder=" Your Phone" class="form-control validate"
              wire:model.defer='login_phone'>
              @error('login_phone')
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>

          <div class="md-form mb-3">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="password" placeholder="Your Password" class="form-control validate"
              wire:model.defer='login_password'>
              @error('login_password')
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>

        </div>
        <div class="d-flex justify-content-center mb-2">
          <button class="btn-default primary-btn radius-0" wire:click='Login()'>Login</button>
        </div>
      </div>
    </div>
  </div>

</div>