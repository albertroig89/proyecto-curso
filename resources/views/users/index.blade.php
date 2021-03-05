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
                      <th scope="col">Eliminar usuario</th>
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
{{--                        <td><a href="{{ route('users.edit', ['id' => $user]) }}">Editar</a></td> FA EL MATEIX QUE LA  LINEA ANTERIOR PERO MES SIMPLIFICAT--}}
{{--                        <td><a href="{{ route('users.edit', $user) }}">Editar</a></td> FA EL MATEIX QUE LES LINEA ANTERIOR PERO ENCARA MES SIMPLIFICAT--}}
                        <td><form action="{{ route('users.destroy', $user) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit">Eliminar</button>
                        </form></td>
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
