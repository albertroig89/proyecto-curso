@extends('layout')

@section('title', "Welcome")

@section('content')

    @empty($nickname)
        <h1>{{ $title }}</h1>
         
         Bienvenido {{$name}}
    @else
        <h1>{{ $title }}</h1>
         
         Bienvenido {{$name}}, tu apodo es {{$nickname}}
    @endempty

         
         
@endsection