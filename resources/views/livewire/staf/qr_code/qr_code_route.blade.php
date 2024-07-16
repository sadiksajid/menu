@extends('staf.layouts.master')
@php
$translations = app('translations_admin');
@endphp

@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">{{$translations['qr_code_list']}}</h4>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <div>
        
        @livewire('staf-qr-code')

    </div>
@endsection
<!-- Row -->