@extends('layouts-index1.app')


@section('content')
    <div>

        @livewire('menu-home',['store'=>$store])

    </div>
@endsection


