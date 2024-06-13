@extends('layouts-index1.app')


@section('content')
    <div>

        @livewire('index-home',['scroll'=>$scroll ?? false])

    </div>
@endsection


