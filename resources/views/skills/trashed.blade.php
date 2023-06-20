@extends('layout')

@section('title', 'Papelera')

@section('content')
    <div class="d-flex justify-content-between align-items-end mt-2">
        <h1 class="pb-1">{{ $title }}</h1>
    </div>
    @if ($skills->count())
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($skills as $skill)
                <tr>
                    <th scope="row">{{ $skill->id }}</th>
                    <td>{{ $skill->name }}</td>
                    <td>
                        @if ($skill->skills_count == 0)
                            <form action="{{ route('skills.destroy', $skill) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link" type="submit"><span id="trash-{{ $skill->id }}" class="oi oi-circle-x"></span></button>
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
    @else
        <li>No hay habilidades en la papelera.</li>
    @endif
@endsection

@section('sidebar')
    @parent
@endsection