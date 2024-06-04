@extends('staf.layouts.master')


@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">About Appino</h4>
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
        @livewire('appino-info')               
    </div>        

@endsection
    <!-- Row -->


    

 

