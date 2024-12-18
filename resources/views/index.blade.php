@extends('layouts.app')

@section('container')
    <?php if(Request::is('/')) : ?>
    @livewire('index')

    <?php elseif(Request::is('login')) : ?>
    @livewire('login')


    <?php endif ?>
@endsection 
