<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Controllers\Controller;

class CitasController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->id())->get();
        return view('admin.citas', compact('appointments'));
    }
}
