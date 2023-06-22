@extends('layout')

@section('title', 'Papelera')

@section('content')
    <div class="d-flex justify-content-between align-items-end mt-2">
        <h1 class="pb-1">{{ $title }}</h1>
    </div>
    @if ($professions->count())
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Recuperar profesion</th>
                <th scope="col">Eliminar profesion definitivamente</th>
            </tr>
            </thead>
            <tbody>
            @foreach($professions as $profession)
                <tr>
                    <th scope="row">{{ $profession->id }}</th>
                    <td>{{ $profession->title }}</td>
                    <td><a href="{{ route('professions.restore', $profession) }}"><i class="oi oi-arrow-circle-left"></i></a></td>
                    <td>
                        <form action="{{ route('professions.destroy', $profession) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link" type="submit"><span id="trash-{{ $profession->id }}" class="oi oi-circle-x"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <li>No hay profesiones en la papelera.</li>
    @endif
@endsection

@section('sidebar')
    @parent
@endsection