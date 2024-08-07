@extends('layouts.app')

@section('title', 'Registro de Citas Médicas')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Formulario de Registro de Cita -->
        <div class="col-md-6 mx-auto">
            <h2 class="mb-4 text-center">Registrar Cita Médica</h2>

            <!-- Mostrar Mensaje de Éxito -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('appointments.store') }}" method="POST" class="form-custom-width">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="petName" name="pet_name" placeholder="Nombre de la Mascota" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="ownerName" name="owner_name" placeholder="Nombre del Propietario" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="contactNumber" name="contact_number" placeholder="Número de Contacto" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required>
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" id="appointmentDate" name="appointment_date" required>
                </div>
                <div class="form-group">
                    <input type="time" class="form-control" id="appointmentTime" name="appointment_time" required>
                </div>
                <div class="form-group">
                    <select class="form-control" id="vet" name="vet" required>
                        <option value="">Selecciona el Veterinario</option>
                        <option>Dr. Juan Pérez</option>
                        <option>Dr. María López</option>
                        <option>Dr. Carlos García</option>
                        <option>Dra. Ana Martínez</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Notas Adicionales"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrar Cita</button>
            </form>
        </div>

        <!-- Tabla de Citas en la Parte Inferior -->
        <div class="col-md-6">
            <h2 class="mb-4 text-center">Mis Citas Médicas</h2>
            
            @if($appointments->isEmpty())
                <p>No tienes citas registradas.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
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
                                        @if ($appointment->status == 'accepted')
                                            <span class="badge badge-success">Aceptada</span>
                                        @elseif ($appointment->status == 'rejected')
                                            <span class="badge badge-danger">Rechazada</span>
                                        @else
                                            <span class="badge badge-warning">Pendiente</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Botón para cancelar la cita -->
                                        @if ($appointment->status == 'pending')
                                            <form action="{{ route('appointments.updateStatus', $appointment) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Agrega CSS personalizado para ajustes adicionales -->
<style>
    .form-custom-width {
        max-width: 400px; /* Ajusta el ancho del formulario */
        margin: 0 auto; /* Centra el formulario horizontalmente */
    }
</style>
@endsection
