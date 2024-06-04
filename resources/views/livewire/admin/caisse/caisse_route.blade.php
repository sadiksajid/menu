@extends('admin.layouts_caisse.master')
@php
$translations = app('translations_admin');
@endphp

<style>
    .order_imgs {
        border: 1px solid black;
        height: 50px !important;
        width: 50px !important;
    }

    .order {
        padding-left: 70px !important;
        padding: 16px;
        min-height: 60px;
    }

    .centered {
        display: flex;
        align-items: center;
        /* Vertical centering */
        justify-content: center;
        /* Horizontal centering */
        margin: 0;
        /* Optional: to reset default margin */
    }


</style>

@section('content')
    <div>
        @if (session()->has('message'))
            <div class="alert ">
                {{ session('message') }}
            </div>
        @endif
        @livewire('caisse')


    </div>
@endsection
<!-- Row -->
