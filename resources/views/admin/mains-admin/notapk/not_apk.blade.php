@extends('admin.layouts.master')


@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Notification Controller</h4>

        </div>
    </div>

    <!--End Page header-->
@endsection
@section('content')
    
        @if (session()->has('message'))
            <div class="alert ">
                {{ session('message') }}
            </div>
        @endif
        {{-- <livewire:send-notification/> --}}
        @livewire('send-notification')
    
@endsection
<!-- Row -->
