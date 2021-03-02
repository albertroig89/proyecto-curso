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
                      <th scope="col">Visualizar detalles usuario</th>
                      <th scope="col">Editar detalles del usuario</th>
                    </tr>
                    </thead>
                    <tbody>
            @foreach ($users as $user)
                      <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ route('users.show', ['id' => $user->id]) }}">Ver detalles</a></td>
                        <!--<td><a href="{{ url('/usuarios/'.$user->id) }}">Ver detalles</a></td> Fa el mateix que la linea anterior-->
                        <td><a href="{{ route('users.edit', ['id' => $user->id]) }}">Editar</a></td>
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
