@extends('layout')

@section('title', "Papelera")

@section('content')
    <div class="d-flex justify-content-between align-items-end mt-2">
        <h1 class="pb-1">{{ $title }}</h1>
    </div>

    @if ($users->count())
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo electronico</th>
                <th scope="col">Recuperar usuario</th>
                <th scope="col">Eliminar usuario definitivamente</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button class="btn btn-link" type="submit"><span id="trash-{{ $user->id }}" class="oi oi-arrow-circle-left"></span></button>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link" type="submit"><span id="trash-{{ $user->id }}" class="oi oi-circle-x"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <li>No hay usuarios en la papelera.</li>
    @endif
@endsection