@extends('admin.layouts.master2')
@section('css')
@endsection
@section('content')
    <div class="page">
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="text-white">
                            <div class="card-body">
                                <center>
                                    <lottie-player src="{{ URL::asset('assets/SVG/code_bar.json') }}"  background="transparent"  speed="0.2"  style="width:30%"  loop  autoplay></lottie-player>
                                </center>
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf
                                    <h4 class="text-white-80 mb-5 text-center" style='margin-top:-50px'>Confirm your Role Please!</h4>
                                    <div class="row">
                                        <div class="col-6 d-block mx-auto" >
                                    

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-lock"></i>
                                                    </div>
                                                </div>
                                                <input type="password" class="form-control" name="password" value="{{ old('password') }}" required autocomplete="current-password" placeholder="Password">
                                                @error('password')
                                                    <span class="invalid-feedback" style='display:block;color:white' role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                     
                                            </div>
                            
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn   btn-block px-4" style="background-color:#7300FF;color:white">Login</button>
                                                </div>
                                      
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

@endsection
