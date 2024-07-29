@extends('layouts.app')

@section('title', 'Lista de Citas Médicas')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Lista de Citas Médicas</h2>
    
    @if($appointments->isEmpty())
        <p>No hay citas registradas.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre de la Mascota</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Veterinario</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->pet_name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ $appointment->appointment_time }}</td>
                        <td>{{ $appointment->vet }}</td>
                        <td>
                            <span class="badge {{ $appointment->status == 'accepted' ? 'badge-success' : 'badge-danger' }}">
                                {{ $appointment->status == 'accepted' ? 'Aceptada' : 'Rechazada' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <!-- Botón de aceptar -->
                                <form action="{{ route('appointments.updateStatus', $appointment) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                                </form>
                                <!-- Botón de rechazar -->
                                <form action="{{ route('appointments.updateStatus', $appointment) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                                </form>
                                <!-- Icono de ojo para ver las notas -->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#notesModal{{ $appointment->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Modals -->
@foreach($appointments as $appointment)
    <!-- Modal -->
    <div class="modal fade" id="notesModal{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="notesModalLabel{{ $appointment->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notesModalLabel{{ $appointment->id }}">Notas de la Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $appointment->notes ?? 'No hay notas adicionales.' }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
