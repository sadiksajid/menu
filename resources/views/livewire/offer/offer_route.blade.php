
@extends('layouts-index1.app')


@section('content')
    <div>

        @livewire('client-offer-view',['store_info'=>$store_info,'offer'=>$offer])

    </div>
@endsection


