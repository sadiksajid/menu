@extends('layouts-index1.app')


@section('content')
    <div>
        @livewire('competition',['id'=>$id])
    </div>
@endsection
