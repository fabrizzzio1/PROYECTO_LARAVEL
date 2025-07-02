@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Reservas</h2>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Fecha</th>
                <th>Hora Entrada</th>
                <th>Hora Salida</th>
                <th>Posición</th>
                <th>Placa</th>
                <th>Tipo de Vehículo</th>
                <th>Sede</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ $reserva->hora_entrada }}</td>
                    <td>{{ $reserva->hora_salida }}</td>
                    <td>{{ $reserva->posicion }}</td>
                    <td>{{ $reserva->placa }}</td>
                    <td>{{ $reserva->tipo_vehiculo }}</td>
                    <td>{{ $reserva->sede->nombre ?? 'Sin sede' }}</td>
                    <td>{{ $reserva->user->name ?? '' }} {{ $reserva->user->surname ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay reservas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection