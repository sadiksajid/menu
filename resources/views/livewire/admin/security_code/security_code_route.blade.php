@extends('admin.layouts.master')
@php
$translations = app('translations_admin');
@endphp

@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">{{$translations['edit_headers']}}</h4>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <div>
        
        @livewire('admin-security-code')

    </div>
@endsection
<!-- Row -->
