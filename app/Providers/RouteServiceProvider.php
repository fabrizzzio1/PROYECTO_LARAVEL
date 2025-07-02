<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Where to redirect users after login.
     */
    public const HOME = '/home'; // Puedes cambiar esto si tu vista inicial es otra

    public function boot(): void
    {
        parent::boot();
    }
}