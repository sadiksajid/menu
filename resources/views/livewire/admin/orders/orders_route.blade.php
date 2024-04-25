@extends('admin.layouts.master')
@php
$translations = app('translations_admin');
@endphp


@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">{{$translations['orders']}}</h4>
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
        @if($type == 'details')
            @livewire('admin-orders-details',['id'=>$id])   
        @endif

    </div>
@endsection
<!-- Row -->
