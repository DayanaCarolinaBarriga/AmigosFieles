@extends('tablar::page')

@section('title', 'Filtrar Animales')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Filtrar Animales') }}
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
                        <form action="{{ route('informes.filters') }}" method="GET">
                            <div class="form-group mb-3">
                                <label class="form-label">Especie</label>
                                <select name="id_especie" class="form-control">
                                    <option value="">Seleccionar Especie</option>
                                    @foreach($especies as $especie)
                                        <option value="{{ $especie->id }}">{{ $especie->especie }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Fecha de Ingreso Desde</label>
                                <input type="date" name="fecha_ingreso_desde" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Fecha de Ingreso Hasta</label>
                                <input type="date" name="fecha_ingreso_hasta" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-control">
                                    <option value="">Seleccionar Estado</option>
                                    <option value="disponible">Disponible</option>
                                    <option value="adoptado">Adoptado</option>
                                    <option value="no_disponible">No Disponible</option>
                                </select>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($animales) && $animales->count() > 0)
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
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Especie</th>
                                            <th>Sexo</th>
                                            <th>Esterilizado</th>
                                            <th>Fecha de Ingreso</th>
                                            <th>Estado</th>
                                            <th>Fecha de Nacimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($animales as $animal)
                                            <tr>
                                                <td>{{ $animal->id }}</td>
                                                <td>{{ $animal->nombre }}</td>
                                                <td>{{ $animal->nombre_especie }}</td>
                                                <td>{{ $animal->sexo }}</td>
                                                <td>{{ $animal->esterilizado ? 'Sí' : 'No' }}</td>
                                                <td>{{ $animal->fecha_ingreso }}</td>
                                                <td>{{ $animal->estado }}</td>
                                                <td>{{ $animal->fecha_nacimiento }}</td>
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
                <form action="{{ route('informes.generatePdf') }}" method="GET" target="_blank">
                    <input type="hidden" name="id_especie" value="{{ request('id_especie') }}">
                    <input type="hidden" name="fecha_ingreso_desde" value="{{ request('fecha_ingreso_desde') }}">
                    <input type="hidden" name="fecha_ingreso_hasta" value="{{ request('fecha_ingreso_hasta') }}">
                    <input type="hidden" name="estado" value="{{ request('estado') }}">
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
