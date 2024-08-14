<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Controllers\Controller;

class CitasController extends Controller
{
    public function index()
    {
        // Traer todas las citas sin importar el user_id
        $appointments = Appointment::all();
        return response()->json($appointments);
    }
}
