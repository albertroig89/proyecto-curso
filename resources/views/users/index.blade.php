@extends('layout')

@section('title', "Usuarios")

@section('content')
    <h1>{{ $title }}</h1> <!-- >?= es una abreviacio de >?php echo -->

    <ul>
        @if ($users->count())
            <table class="table table-striped">
                    <thead>
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Correo electronico</th>
                    </tr>
                    </thead>
                    <tbody>
            @foreach ($users as $user)
                      <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                      </tr>
            @endforeach
            </tbody>
            </table>
        @else
            <li>No hay usuarios registrados.</li>
        @endif
    </ul>
@endsection

@section('sidebar')
    @parent
    <h2>Barra lateral personalizada!</h2>
@endsection
