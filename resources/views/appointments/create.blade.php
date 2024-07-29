@extends('layouts.app')

@section('title', 'Registro de Citas Médicas')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Formulario de Registro de Cita -->
        <div class="col-md-6">
            <h2 class="mb-4">Registrar Cita Médica</h2>

            <!-- Mostrar Mensaje de Éxito -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="petName">Nombre de la Mascota</label>
                    <input type="text" class="form-control" id="petName" name="pet_name" placeholder="Ingresa el nombre de tu mascota" required>
                </div>
                <div class="form-group">
                    <label for="ownerName">Nombre del Propietario</label>
                    <input type="text" class="form-control" id="ownerName" name="owner_name" placeholder="Ingresa tu nombre" required>
                </div>
                <div class="form-group">
                    <label for="contactNumber">Número de Contacto</label>
                    <input type="text" class="form-control" id="contactNumber" name="contact_number" placeholder="Ingresa tu número de contacto" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico" required>
                </div>
                <div class="form-group">
                    <label for="appointmentDate">Fecha de la Cita</label>
                    <input type="date" class="form-control" id="appointmentDate" name="appointment_date" required>
                </div>
                <div class="form-group">
                    <label for="appointmentTime">Hora de la Cita</label>
                    <input type="time" class="form-control" id="appointmentTime" name="appointment_time" required>
                </div>
                <div class="form-group">
                    <label for="vet">Selecciona el Veterinario</label>
                    <select class="form-control" id="vet" name="vet" required>
                        <option>Dr. Juan Pérez</option>
                        <option>Dr. María López</option>
                        <option>Dr. Carlos García</option>
                        <option>Dra. Ana Martínez</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="notes">Notas Adicionales</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Ingresa cualquier nota adicional"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Registrar Cita</button>
            </form>
        </div>

        <!-- Tabla de Citas en la Parte Inferior -->
        <div class="col-md-6">
            <h2 class="mb-4">Mis Citas Médicas</h2>
            
            @if($appointments->isEmpty())
                <p>No tienes citas registradas.</p>
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
                                <td>
                                    <!-- <form action="{{ route('appointments.updateStatus', $appointment) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                                    </form> -->
                                    <form action="{{ route('appointments.updateStatus', $appointment) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
