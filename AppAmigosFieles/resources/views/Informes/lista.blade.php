@extends('layouts.app')

@section('template_title')
    Listado de Adopciones
@endsection

@section('content')
    <div class="container">
        <h2>Búsqueda de Adopciones</h2>
        <form action="{{ route('adopciones.filter') }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nombre_animal">Nombre del Animal</label>
                        <input type="text" class="form-control" name="nombre_animal" value="{{ request('nombre_animal') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nombre_adoptante">Nombre del Adoptante</label>
                        <input type="text" class="form-control" name="nombre_adoptante" value="{{ request('nombre_adoptante') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="estado_proceso">Estado del Proceso</label>
                        <select class="form-control" name="estado_proceso">
                            <option value="">Todos</option>
                            <option value="pendiente" {{ request('estado_proceso') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="aprobado" {{ request('estado_proceso') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                            <option value="rechazado" {{ request('estado_proceso') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="visita_previa">Visita Previa</label>
                        <select class="form-control" name="visita_previa">
                            <option value="">Todos</option>
                            <option value="1" {{ request('visita_previa') == '1' ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ request('visita_previa') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_desde">Fecha Desde</label>
                        <input type="date" class="form-control" name="fecha_desde" value="{{ request('fecha_desde') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_hasta">Fecha Hasta</label>
                        <input type="date" class="form-control" name="fecha_hasta" value="{{ request('fecha_hasta') }}">
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ route('adopciones.filter') }}" class="btn btn-secondary">Limpiar</a>
                </div>
            </div>
        </form>

        <div class="mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Animal</th>
                        <th>Adoptante</th>
                        <th>Estado</th>
                        <th>Fecha Adopción</th>
                        <th>Visita Previa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($adopciones as $adopcion)
                        <tr>
                            <td>{{ $adopcion->id }}</td>
                            <td>{{ $adopcion->animale->nombre }}</td>
                            <td>{{ $adopcion->adoptante->nombre }}</td>
                            <td>{{ $adopcion->estado_proceso }}</td>
                            <td>{{ $adopcion->fecha_adopcion }}</td>
                            <td>{{ $adopcion->visita_previa ? 'Sí' : 'No' }}</td>
                            <td>
                                <a href="{{ route('adopciones.show', $adopcion->id) }}" class="btn btn-sm btn-primary">Ver</a>
                                <a href="{{ route('adopciones.edit', $adopcion->id) }}" class="btn btn-sm btn-success">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $adopciones->links() }}
        </div>
    </div>
@endsection