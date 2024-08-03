<?php
namespace App\Http\Controllers;

class FacturasController extends Controller
{
    public function index()
    {
        return view('admin.facturas');
    }
}
