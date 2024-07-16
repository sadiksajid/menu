@extends('admin.layouts.master')
@php
$translations = app('translations_admin');
@endphp

@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">{{$translations['marketing_tool']}}</h4>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <div>
        
        @livewire('admin-marketing')

    </div>
@endsection
<!-- Row -->
