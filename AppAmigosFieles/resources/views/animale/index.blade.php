@extends('tablar::page')

@section('title')
    Animales
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Lista
                    </div>
                    <h2 class="page-title">
                        {{ __('Animales ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('animales.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Registrar Animales
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
                            <h3 class="card-title">Animales</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Mostrar
                                    <div class="mx-2 d-inline-block">
                                        <!-- Campo para elegir cuántos registros mostrar -->
                                        <input type="number" id="entriesCount" class="form-control form-control-sm" value="{{ request()->get('entries', 10) }}" size="3" aria-label="Invoices count">
                                    </div>
                                    registros
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
                        <div class="table-responsive min-vh-100">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                                           aria-label="Select all invoices"></th>
                                    <th class="w-1">No.</th>
                                    <th>Nombre</th>
                                    <th>Especie</th>
                                    <th>Sexo</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Esterilizado</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Estado</th>
                                    <th>Foto</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse ($animales as $animale)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                   aria-label="Select animale"></td>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $animale->nombre }}</td>
                                        <td>{{ $animale->especie->especie }}</td>  
                                        <td>{{ $animale->sexo }}</td>
                                        <td>{{ $animale->fecha_nacimiento }}</td>
                                
                                        <td>
                                            @if($animale->esterilizado == 1)
                                                Sí
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>{{ $animale->fecha_ingreso }}</td>
                                        <td>{{ $animale->estado }}</td>
                                        <td>
                                            @if($animale->foto_path)
                                                <img src="{{ asset('storage/' . $animale->foto_path) }}" alt="Foto de {{ $animale->nombre }}" width="100">
                                            @else
                                                <span>No disponible</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top"
                                                            data-bs-toggle="dropdown">
                                                        Acciones
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                           href="{{ route('animales.show',$animale->id) }}">
                                                            Ver
                                                        </a>
                                                        <a class="dropdown-item"
                                                           href="{{ route('animales.edit',$animale->id) }}">
                                                            Editar
                                                        </a>
                                                        <form
                                                            action="{{ route('animales.destroy',$animale->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    onclick="if(!confirm('¿Quieres proceder?')){return false;}"
                                                                    class="dropdown-item text-red"><i
                                                                    class="fa fa-fw fa-trash"></i>
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
                                        <td colspan="10" class="text-center">No se encontraron datos</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                       <div class="card-footer d-flex align-items-center">
                            {!! $animales->links('tablar::pagination') !!}
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
