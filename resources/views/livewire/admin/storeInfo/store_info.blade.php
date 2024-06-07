@extends('admin.layouts.master')
@php
$translations = app('translations_admin');
@endphp

@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">{{$translations['store_info']}}</h4>
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

        @livewire('store-info')


    </div>
@endsection
<!-- Row -->
