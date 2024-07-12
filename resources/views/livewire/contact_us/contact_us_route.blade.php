@extends('layouts-index1.app')


@section('content')
    <div>

        @livewire('contact-us',['store_info'=>$store_info])

    </div>
@endsection


