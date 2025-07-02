<?php

// app/Models/Sede.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $fillable = ['nombre', 'direccion'];

    public function reservas()
    {
        return $this->hasMany(Reserva::class); // ← sede_id en reservas
    }
}