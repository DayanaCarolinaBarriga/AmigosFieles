@extends('tablar::page')

@section('title', 'Ver Adoptante')

@section('content')
    <!-- Encabezado de la página -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Subtítulo de la página -->
                    <div class="page-pretitle">
                        Ver
                    </div>
                    <h2 class="page-title">
                        {{ __('Adoptante') }}
                    </h2>
                </div>
                <!-- Acciones del título de la página -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('adoptantes.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Icono -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Lista de Adoptantes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cuerpo de la página -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    @if(config('tablar','display_alert'))
                        @include('tablar::common.alert')
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles del Adoptante</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <strong>Nombre:</strong>
                                {{ $adoptante->nombre }}
                            </div>
                            <div class="form-group">
                                <strong>Teléfono:</strong>
                                {{ $adoptante->telefono }}
                            </div>
                            <div class="form-group">
                                <strong>Correo:</strong>
                                {{ $adoptante->correo }}
                            </div>
                            <div class="form-group">
                                <strong>Dirección:</strong>
                                {{ $adoptante->direccion }}
                            </div>
                            <div class="form-group">
                                <strong>Cédula:</strong>
                                {{ $adoptante->cedula }}
                            </div>
                            <div class="form-group">
                                <strong>Edad:</strong>
                                {{ $adoptante->edad }}
                            </div>
                            <div class="form-group">
                                <strong>Ocupación:</strong>
                                {{ $adoptante->ocupacion }}
                            </div>
                            <div class="form-group">
                                <strong>Estado:</strong>
                                {{ $adoptante->estado }}
                            </div>
                            <div class="form-group">
                                <strong>Tipo de Vivienda:</strong>
                                {{ $adoptante->tipo_vivienda }}
                            </div>
                            <div class="form-group">
                                <strong>¿Tiene Cerramiento?:</strong>
                                {{ $adoptante->cerramiento ? 'Sí' : 'No' }}
                            </div>
                            <div class="form-group">
                                <strong>¿Vivienda Arrendada?:</strong>
                                {{ $adoptante->vivienda_arrendada ? 'Sí' : 'No' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
