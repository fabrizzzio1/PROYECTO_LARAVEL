<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\Admin\SedeController;
use App\Http\Controllers\Admin\ReservaAdminController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Middleware\IsAdmin;

Route::get('/reporte/descargar', [ReporteController::class, 'descargarReporte'])->name('reporte.descargar');

Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

Route::view('/servicios', 'servicios')->name('servicios');
Route::view('/tarifas', 'tarifas')->name('tarifas');
Route::view('/contacto', 'contacto')->name('contacto');

// Página de inicio personalizada (landing con sedes)
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Rutas de reservas por sede
Route::get('/reservas/sede/{sede}', [ReservaController::class, 'reservaPorSede'])->name('reservas.sede');

// Rutas de reservas (sin admin)
Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::post('/reservas/{id}/salida', [ReservaController::class, 'registrarSalida'])->name('reservas.salida');
Route::get('/reservas/ticket/{id}', [ReservaController::class, 'ticket'])->name('reservas.ticket');
Route::get('/reservas/sede/{sede}', [App\Http\Controllers\ReservaController::class, 'reservaPorSede'])->name('reservas.reservaPorSede');

// Configuración avanzada (Livewire Volt)
Route::redirect('settings', 'settings/profile');
Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
Volt::route('settings/password', 'settings.password')->name('settings.password');
Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

// Rutas de perfil (solo requieren auth)
Route::middleware(['auth'])->group(function () {
    // Ver perfil (solo mostrar)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    // Configuraciones (editar perfil)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

// Registro de usuario
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Vistas estáticas
Route::get('/parking', function () {
    return view('parking');
})->name('parking');

Route::get('/ubicacion', function () {
    return view('ubicacion');
});

Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');

// Dashboard (si usas Jetstream o similar)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Auth scaffolding
require __DIR__.'/auth.php';
Auth::routes();

// HomeController (si lo usas)
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
});

//SOLO ADMIN

Route::middleware(App\Http\Middleware\IsAdmin::class)->prefix('admin')->group(function () {
    Route::get('/sedes', [SedeController::class, 'index'])->name('admin.sedes');
});
Route::middleware(App\Http\Middleware\IsAdmin::class)->name('admin.')->group(function () {
    Route::post('/sedes', [SedeController::class, 'store'])->name('sedes.store');
});

Route::middleware(App\Http\Middleware\IsAdmin::class)->prefix('admin')->group(function () {
    Route::get('/reservas', [ReservaAdminController::class, 'index'])->name('admin.reservas');
});

Route::middleware(App\Http\Middleware\IsAdmin::class)->prefix('admin')->group(function () {
    Route::get('/usuarios', [UserController::class, 'index'])->name('admin.usuarios');
});


