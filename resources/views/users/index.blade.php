@extends('layout')

@section('title', "Usuarios")

@section('content')
{{--    <h1>{{ $title }}</h1> <!-- >?= es una abreviacio de >?php echo -->--}}
<div class="d-flex justify-content-between align-items-end mt-2">
    <h1 class="pb-1">{{ $title }}</h1>
</div>
@if ($users->count())
    <table class="table table-striped">
            <thead  class="thead-dark">
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


{{--                  @if($user->trashed())--}}
{{--                      <td><form action="{{ route('users.destroy', $user) }}" method="POST">--}}
{{--                              @csrf       --}}{{--A partir de Laravel 5.6--}}
{{--                              @method('DELETE')--}}
{{--                              <button class="btn btn-link" type="submit"><span id="trash-{{ $user->id }}" class="oi oi-circle-x"></span></button>--}}
{{--                      </form></td>--}}
{{--                  @else--}}
                      <form action="{{ route('users.trash', $user) }}" method="POST">
                              @csrf       {{--A partir de Laravel 5.6--}}
                              @method('PATCH')

                              {{--                                {{ csrf_field() }}      Per a versions anteriors a laravel 5.6--}}
                              {{--                                {{ method_field('PATCH') }}--}}

                              <td><a href="{{ route('users.show', ['id' => $user->id]) }}"><span class="oi oi-eye"></span></a></td>
                              <!--<td><a href="{{ url('/usuarios/'.$user->id) }}">Ver detalles</a></td> Fa el mateix que la linea anterior-->
                              <td><a href="{{ route('users.edit', ['id' => $user->id]) }}"><span class="oi oi-pencil" name="edit"></span></a></td>
                              {{--                        <td><a href="{{ route('users.edit', ['id' => $user]) }}">Editar</a></td> FA EL MATEIX QUE LA  LINEA ANTERIOR PERO MES SIMPLIFICAT--}}
                              {{--                        <td><a href="{{ route('users.edit', $user) }}">Editar</a></td> FA EL MATEIX QUE LES LINEA ANTERIOR PERO ENCARA MES SIMPLIFICAT--}}
                                <td><button class="btn btn-link" type="submit"><span id="trash-{{ $user->id }}" class="oi oi-trash"></span></button></td>
                      </form>
{{--                  @endif--}}
              </tr>
    @endforeach
    </tbody>
    </table>
@else
    <li>No hay usuarios registrados.</li>
@endif

@endsection

