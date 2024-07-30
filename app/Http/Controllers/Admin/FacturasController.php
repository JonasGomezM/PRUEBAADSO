<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacturasController extends Controller
{
    public function index()
    {
        return view('admin.facturas');
    }
}
