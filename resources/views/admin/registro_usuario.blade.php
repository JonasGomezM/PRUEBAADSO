@extends('admin.index')

@section('container')
    <h1>Registro de Usuario</h1>
    <p>Esta es la vista para registrar nuevos usuarios.</p>
    <a href="{{ route('admin.create_user') }}" class="btn btn-primary">Agregar Nuevo Usuario</a>

    <h2>Lista de Usuarios</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('admin.edit_user', $user->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('admin.delete_user', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
