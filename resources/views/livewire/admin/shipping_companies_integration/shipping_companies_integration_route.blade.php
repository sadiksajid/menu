@extends('admin.layouts.master')
@php
$translations = app('translations_admin');
@endphp

@section('css') 
    <link href="{{URL::asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}?v=2" rel="stylesheet" />				
@endsection 

@section('content')
    <div>
        @livewire('admin-shipping-company-integration',[$tag,$company_info])
    </div>
@endsection
<!-- Row -->
