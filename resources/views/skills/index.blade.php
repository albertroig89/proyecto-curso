@extends('layout')

@section('title', 'Habilidades')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h1 class="pb-1">Listado de habilidades</h1>
    </div>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Habilidades assignadas a usuarios</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($skills as $skill)
            <tr>
                <th scope="row">{{ $skill->id }}</th>
                <td>{{ $skill->name }}</td>
                <td>{{ $skill->skills_count }}</td>
                <td>
                    @if ($skill->skills_count == 0)
                        <form action="{{ url("habilidades/{$skill->id}") }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                        </form>
                    @else
                        <form action="{{ url("habilidades/{$skill->id}") }}" method="POST">
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