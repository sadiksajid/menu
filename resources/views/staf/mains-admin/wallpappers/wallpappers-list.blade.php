@extends('staf.layouts.master')


@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Wallpappers List</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fe fe-layout  mr-2 fs-14"></i>Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Wallpappers List</a></li>
            </ol>
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
            @livewire('wallpappers-list')               

            
    </div>        

@endsection
    <!-- Row -->


    

 

