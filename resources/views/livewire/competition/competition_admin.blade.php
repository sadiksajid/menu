<div>

    <div class="hero_single inner_pages background-image" style="height:260px" @if (isset($competition_img))
        data-background="url({{ get_image($competition_img)}})" @else
        data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif>

        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1> {{ $translations_resto['competition'] }} </h1>
                        {{-- <p  >{{ $titles['title-2'] ?? 'Cooking delicious and tasty food since 2005' }} </p> --}}
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    <!-- /hero_single -->

    <div class="container">
        <div class="row mt-2 mb-5">
            @foreach ( $clients as $client)
            <div class="  col-md-6 col-12 ">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12 col-12 card_p1">

                                <center>
                                    <h5 style=";margin:0px" class="mb-1 mt-1">
                                        <span class="badge badge-dark"> Name : {{$client->fullname}}
                                        </span>
                                        <span class="badge badge-dark ">Phone : {{$client->phone}}
                                        </span>

                                    </h5>

                                </center>

                            </div>
                            <div class="col-md-12 col-12">
                                <div class="container ">
                                    <div class="row  menu-gallery mt-3 mb-3">
                                        <div class="col-8">
                                            <i class="fas fa-envelope prefix grey-text">Pull Ups</i>
                                            <input type="number" placeholder="PullUp" value=''
                                                class="form-control validate"
                                                wire:model.defer='pull_up.{{$client->id}}'>
                                            @error('pull_up')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-md btn-dark mt-4" style="width:100%"
                                                wire:click='savePull({{$client->id}})'  wire:loading.remove wire:target="savePull({{$client->id}})">Save</button>
                                            <button class="btn btn-md btn-dark mt-4  d-none"  wire:loading.class.remove="d-none" wire:target="savePull({{$client->id}})">Saving ...</button>
                                        </div>
                                        <div class="col-12">
                                            @if($client->is_winner == 0)
                                            <button class="btn btn-md btn-warning mt-4" style="width:100%"
                                                wire:click='SaveWinner({{$client->id}})'>Is Winner ?</button>
                                            @else
                                            <div class="row">
                                                <div class="col-8">
                                                    <button class="btn btn-md btn-success mt-4"
                                                        style="width:100%">Winner</button>
                                                </div>
                                                <div class="col-4">
                                                    <button class="btn btn-md btn-danger mt-4"
                                                        wire:click='BackWinner({{$client->id}})'
                                                        style="width:100%">Cancel</button>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</div>