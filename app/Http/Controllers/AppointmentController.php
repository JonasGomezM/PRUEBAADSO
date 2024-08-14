<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function create()
    {
        // Obtener las citas del usuario autenticado
        $appointments = Appointment::where('user_id', auth())->get();
        return view('appointments.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'pet_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'vet' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Crear una nueva cita
        $appointment = Appointment::create([
            'pet_name' => $request->pet_name,
            'owner_name' => $request->owner_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'vet' => $request->vet,
            'notes' => $request->notes,
            'user_id' => auth(), // Asignar el usuario autenticado
            'status' => 'pending', // Estado inicial
        ]);

        // Redirigir a la vista de creación con mensaje de éxito
        return redirect()->route('appointments.create')->with('success', 'Cita médica registrada correctamente.');
    }

    public function index()
    {
        // Obtener todas las citas
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        // Actualizar el estado de la cita
        $appointment->update([
            'status' => $request->status,
        ]);

        // Redirigir de vuelta a la misma página
        return redirect()->back()->with('success', 'El estado de la cita se ha actualizado correctamente.');
    }
}
