<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        // Obtener las citas del usuario autenticado
        $appointments = Appointment::where('user_id', auth())->get();
        return response()->json($appointments);
    }

    public function store(Request $request)
    {
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

        $appointment = Appointment::create([
            'pet_name' => $request->pet_name,
            'owner_name' => $request->owner_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'vet' => $request->vet,
            'notes' => $request->notes,
            'user_id' => auth(),
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Cita médica registrada correctamente.', 'appointment' => $appointment]);
    }

    public function index()
    {
        $appointments = Appointment::all();
        return response()->json($appointments);
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $appointment->update([
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'El estado de la cita se ha actualizado correctamente.', 'appointment' => $appointment]);
    }
}
