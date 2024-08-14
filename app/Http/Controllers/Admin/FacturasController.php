<?php

namespace App\Http\Controllers;

class FacturasController extends Controller
{
    public function index()
    {
        // Suponiendo que deseas devolver un mensaje o un conjunto de datos
        return response()->json(['message' => 'Facturas cargadas correctamente']);
    }
}
