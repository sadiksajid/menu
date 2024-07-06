{{-- @extends('layouts.app')


@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Products List</h4>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <div>
        @if (session()->has('message'))
            <div class="alert ">
                {{ session('message') }}
            </div>
        @endif

        @livewire('store-client',['store_info'=>$store_info,'category'=>$category])


    </div>
@endsection
<!-- Row --> --}}
@extends('layouts-index1.app')


@section('content')
    <div>

        @if ($category == 'offers')
            @livewire('client-offers',['store_info'=>$store_info])
        @else
            @livewire('store-client',['store_info'=>$store_info,'category'=>$category])
        @endif


    </div>
@endsection
