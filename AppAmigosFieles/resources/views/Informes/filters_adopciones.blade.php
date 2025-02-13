@extends('tablar::page')

@section('title', 'Filtrar Adopciones')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Filtrar Adopciones') }}
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('informes.filters_adopciones') }}" method="GET">
                            <div class="form-group mb-3">
                                <label class="form-label">Animal</label>
                                <select name="id_animal" class="form-control">
                                    <option value="">Seleccionar Animal</option>
                                    @foreach($animales as $animal)
                                        <option value="{{ $animal->id }}">{{ $animal->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Adoptante</label>
                                <select name="id_adoptante" class="form-control">
                                    <option value="">Seleccionar Adoptante</option>
                                    @foreach($adoptantes as $adoptante)
                                        <option value="{{ $adoptante->id }}">{{ $adoptante->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Estado del Proceso</label>
                                <select name="estado_proceso" class="form-control">
                                    <option value="">Seleccionar Estado</option>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="aprobado">Aprobado</option>
                                    <option value="rechazado">Rechazado</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Fecha de Adopción Desde</label>
                                <input type="date" name="fecha_adopcion_desde" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Fecha de Adopción Hasta</label>
                                <input type="date" name="fecha_adopcion_hasta" class="form-control">
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($adopciones) && $adopciones->count() > 0)
            <div class="row row-cards mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Resultados de la Búsqueda</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Animal</th>
                                            <th>Adoptante</th>
                                            <th>Estado</th>
                                            <th>Fecha Adopción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($adopciones as $adopcion)
                                            <tr>
                                                <td>{{ $adopcion->animale->nombre }}</td>
                                                <td>{{ $adopcion->adoptante->nombre }}</td>
                                                <td>{{ $adopcion->estado_proceso }}</td>
                                                <td>{{ $adopcion->fecha_adopcion }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón para generar PDF -->
            <div class="row row-cards mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('informes.generatePdf_adopciones') }}" method="GET" target="_blank">
                                <input type="hidden" name="id_animal" value="{{ request('id_animal') }}">
                                <input type="hidden" name="id_adoptante" value="{{ request('id_adoptante') }}">
                                <input type="hidden" name="estado_proceso" value="{{ request('estado_proceso') }}">
                                <input type="hidden" name="fecha_adopcion_desde" value="{{ request('fecha_adopcion_desde') }}">
                                <input type="hidden" name="fecha_adopcion_hasta" value="{{ request('fecha_adopcion_hasta') }}">
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-secondary">Generar PDF</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row row-cards mt-4">
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No se encontraron resultados.
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
