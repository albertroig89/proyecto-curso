@extends('layout')

@section('title', "Menu")

@section('content')

        <h1>{{ $title }}</h1>

        <a href="usuarios">Mostrar usuarios</a><br>
        <a href="usuarios?empty">Mostrar usuarios vacio</a><br>
        <a href="usuarios/1">Mostrar detalle usuarios</a><br>
        <a href="usuarios/nuevo">Crear usuarios</a><br>
        <a href="usuarios/1/edit">Editar usuarios</a><br>
        <a href="saludo/albert">Saludo</a><br>
        <a href="saludo/albert/sdarcknes">Saludo nickname</a><br>
        
@endsection
