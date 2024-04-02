@extends('admin.layouts.master')


@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Offers List</h4>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <div>
        
        @livewire('admin-offers',[$page,$id])

    </div>
@endsection
<!-- Row -->
