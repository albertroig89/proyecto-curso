@extends('layout')

@section('title', "Usuarios")

@section('content')
    <h1>{{ $title }}</h1> <!-- >?= es una abreviacio de >?php echo -->

    <ul>

        @forelse ($users as $user)
            <li>{{ $user }}</li> <!--e($user) el que fa es ometre la lectura si algu ens coloca codic de html o javascript aon tindria que anar el nom d'usuari-->
        @empty
            <li>No hay usuarios registrados.</li>

        @endforelse

    </ul>
@endsection

@section('sidebar')
    @parent
    <h2>Barra lateral personalizada!</h2>
@endsection
