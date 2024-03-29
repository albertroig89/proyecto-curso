@extends('layout')

@section('title', 'Profesiones')

@section('content')
    <div class="d-flex justify-content-between align-items-end mt-2">
        <h1 class="pb-1">Listado de profesiones</h1>
    </div>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Perfiles</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($professions as $profession)
            <tr>
                <th scope="row">{{ $profession->id }}</th>
                <td>{{ $profession->title }}</td>
                <td>{{ $profession->profiles_count }}</td>
                <td>
                    @if ($profession->profiles_count == 0)
                        <form action="{{ route('professions.trash', $profession) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                        </form>
                    @else
                        <form action="{{ url("profesiones/{$profession->id}") }}" method="POST">
                            <button type="submit" class="btn btn-link disabled"><span class="oi oi-trash"></span></button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('sidebar')
    @parent
@endsection