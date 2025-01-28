@extends('tablar::page')

@section('title')
    Adoptantes
@endsection

@section('content')
    <!-- Encabezado de la página -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Subtítulo de la página -->
                    <div class="page-pretitle">
                        Lista
                    </div>
                    <h2 class="page-title">
                        {{ __('Adoptantes') }}
                    </h2>
                </div>
                <!-- Acciones del título de la página -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('adoptantes.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Icono de añadir -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Registrar Adoptante
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cuerpo de la página -->
    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar', 'display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Adoptantes</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <!-- Campo para elegir cuántos registros mostrar -->
                                        <input type="number" id="entriesCount" class="form-control form-control-sm" value="{{ request()->get('entries', 10) }}" size="3" aria-label="Invoices count">
                                    </div>
                                    entradas
                                </div>
                                <div class="ms-auto text-muted">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <!-- Campo de búsqueda -->
                                        <input type="text" id="searchInput" class="form-control form-control-sm" value="{{ request()->get('search', '') }}" aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de adoptantes -->
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">
                                            <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all adoptantes">
                                        </th>
                                        <th class="w-1">No.</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Dirección</th>
                                        <th>Cédula</th>
                                        <th>Edad</th>
                                        <th>Ocupación</th>
                                        <th>Estado</th>
                                        <th>Tipo de Vivienda</th>
                                        <th>¿Tiene Cerramiento?</th>
                                        <th>¿Vivienda Arrendada?</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($adoptantes as $adoptante)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select adoptante"></td>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $adoptante->nombre }}</td>
                                            <td>{{ $adoptante->telefono }}</td>
                                            <td>{{ $adoptante->correo }}</td>
                                            <td>{{ $adoptante->direccion }}</td>
                                            <td>{{ $adoptante->cedula }}</td>
                                            <td>{{ $adoptante->edad }}</td>
                                            <td>{{ $adoptante->ocupacion }}</td>
                                            <td>{{ $adoptante->estado }}</td>
                                            <td>{{ $adoptante->tipo_vivienda }}</td>
                                            <td>{{ $adoptante->cerramiento ? 'Sí' : 'No' }}</td>
                                            <td>{{ $adoptante->vivienda_arrendada ? 'Sí' : 'No' }}</td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                            Acciones
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{ route('adoptantes.show', $adoptante->id) }}">
                                                                Ver
                                                            </a>
                                                            <a class="dropdown-item" href="{{ route('adoptantes.edit', $adoptante->id) }}">
                                                                Editar
                                                            </a>
                                                            <form action="{{ route('adoptantes.destroy', $adoptante->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="if(!confirm('¿Deseas continuar?')){return false;}" class="dropdown-item text-red">
                                                                    <i class="fa fa-fw fa-trash"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center">No se encontraron datos.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="card-footer d-flex align-items-center">
                            {!! $adoptantes->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar el cambio de número de registros y la búsqueda -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const entriesCountInput = document.getElementById('entriesCount');
            const searchInput = document.getElementById('searchInput');
            
            // Cambiar el número de registros a mostrar
            entriesCountInput.addEventListener('change', function () {
                const entries = entriesCountInput.value;
                const search = searchInput.value;
                window.location.href = `?entries=${entries}&search=${search}`;
            });

            // Cambiar el término de búsqueda
            searchInput.addEventListener('input', function () {
                const entries = entriesCountInput.value;
                const search = searchInput.value;
                window.location.href = `?entries=${entries}&search=${search}`;
            });
        });
    </script>
@endsection
