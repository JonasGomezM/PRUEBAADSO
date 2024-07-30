<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroUsuarioController extends Controller
{
    public function index()
    {
        return view('admin.registro_usuario');
    }
}
