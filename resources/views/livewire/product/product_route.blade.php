
@extends('layouts-index1.app')


@section('content')
    <div>

        @livewire('product',['store_info'=>$store_info,'product_info'=>$product_info])

    </div>
@endsection


