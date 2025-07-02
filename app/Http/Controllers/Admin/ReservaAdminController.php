<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserva;

class ReservaAdminController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['sede', 'user'])->get();
        return view('admin.reservas', compact('reservas'));
    }
}