@extends('tablar::page')

@section('title')
    Adopciones
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Lista
                    </div>
                    <h2 class="page-title">
                        {{ __('Adopciones') }}
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('adopciones.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Registrar Adopción
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(config('tablar','display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Adopciones</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <input type="number" id="entriesCount" class="form-control form-control-sm" value="{{ request()->get('entries', 10) }}" size="3" aria-label="Adopciones count">
                                    </div>
                                    entradas
                                </div>
                                <div class="ms-auto text-muted">
                                    Buscar:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" id="searchInput" class="form-control form-control-sm" value="{{ request()->get('search', '') }}" aria-label="Search adoption">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th class="w-1">
                                        <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all adopciones">
                                    </th>
                                    <th class="w-1">No.</th>
                                    <th>Animal</th>
                                    <th>Adoptante</th>
                                    <th>Fecha de Adopción</th>
                                    <th>Estado</th>
                                    <th>Cédula</th>
                                    <th>Formulario</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 0; @endphp <!-- Inicializamos la variable $i -->
                                @forelse ($adopciones as $adopcion)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select adopcion"></td>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $adopcion->animale->nombre}}</td>
                                        <td>{{ $adopcion->adoptante->nombre ?? 'Desconocido' }}</td>
                                        <td>{{ $adopcion->fecha_adopcion ?? 'No disponible' }}</td>
                                        <td>{{ $adopcion->estado_proceso }}</td>
                                        <td><a href="{{ asset('storage/' . $adopcion->cedula_path) }}" target="_blank">Ver Cédula</a></td>
                                        <td><a href="{{ asset('storage/' . $adopcion->formulario_path) }}" target="_blank">Ver Formulario</a></td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="{{ route('adopciones.show', $adopcion->id) }}">
                                                            Ver
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('adopciones.edit', $adopcion->id) }}">
                                                            Editar
                                                        </a>
                                                        <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="if(!confirm('¿Deseas continuar?')){return false;}" class="dropdown-item text-red">
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No se encontraron datos.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {!! $adopciones->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const entriesCountInput = document.getElementById('entriesCount');
            const searchInput = document.getElementById('searchInput');

            entriesCountInput.addEventListener('change', function () {
                const entries = entriesCountInput.value;
                const search = searchInput.value;
                window.location.href = `?entries=${entries}&search=${search}`;
            });

            searchInput.addEventListener('input', function () {
                const entries = entriesCountInput.value;
                const search = searchInput.value;
                window.location.href = `?entries=${entries}&search=${search}`;
            });
        });
    </script>
@endsection