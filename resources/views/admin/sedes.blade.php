@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Sedes</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearSedeModal">Agregar nueva sede</button>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Total de Reservas</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sedes as $sede)
            <tr>
                <td>{{ $sede->nombre }}</td>
                <td>{{ $sede->direccion }}</td>
                <td>{{ $sede->reservas_count }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No hay sedes registradas.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="crearSedeModal" tabindex="-1" aria-labelledby="crearSedeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.sedes.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearSedeModalLabel">Agregar Nueva Sede</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la sede</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection