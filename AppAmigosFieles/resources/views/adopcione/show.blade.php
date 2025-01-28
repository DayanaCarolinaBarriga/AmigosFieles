@extends('tablar::page')

@section('title', 'View Adopcione')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Ver
                    </div>
                    <h2 class="page-title">
                        {{ __('Adopcion ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('adopciones.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Lista de Adopcines
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    @if(config('tablar.display_alert', false))
                        @include('tablar::common.alert')
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles de adopción</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <strong>Animal:</strong>
                                {{ $adopcione->animale->nombre ?? 'No disponible' }}
                            </div>
                            <div class="form-group">
                                <strong>Adoptante:</strong>
                                {{ $adopcione->adoptante->nombre ?? 'No disponible' }}
                            </div>
                            <div class="form-group">
                                <strong>Fecha Adopcion:</strong>
                                {{ $adopcione->fecha_adopcion ?? 'No disponible' }}
                            </div>
                            <div class="form-group">
                                <strong>Estado Proceso:</strong>
                                {{ $adopcione->estado_proceso ?? 'No disponible' }}
                            </div>
                            <div class="form-group">
                                <strong>Cédula (PDF):</strong>
                                @if($adopcione->cedula_path)
                                    <a href="{{ Storage::url($adopcione->cedula_path) }}" target="_blank">Ver Cédula</a>
                                @else
                                    <span>No disponible</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <strong>Formulario (PDF):</strong>
                                @if($adopcione->formulario_path)
                                    <a href="{{ Storage::url($adopcione->formulario_path) }}" target="_blank">Ver Formulario</a>
                                @else
                                    <span>No disponible</span>
                                @endif
                            </div>
                            
                            <!-- Nuevos campos añadidos -->
                            <div class="form-group">
                                <strong>Visita Previa:</strong>
                                {{ $adopcione->visita_previa ? 'Sí' : 'No' }}
                            </div>
                            <div class="form-group">
                                <strong>Comentarios de Visita:</strong>
                                {{ $adopcione->comentarios_visita ?? 'No disponible' }}
                            </div>
                            <div class="form-group">
                                <strong>Condiciones que afectan la adopción:</strong>
                                {{ $adopcione->condiciones_adopcion ?? 'No disponibles' }}
                            </div>
                            <div class="form-group">
                                <strong>Tipo de Vivienda:</strong>
                                {{ $adopcione->adoptante->tipo_vivienda ?? 'No disponible' }}
                            </div>
                            <div class="form-group">
                                <strong>Cerramiento:</strong>
                                {{ $adopcione->adoptante->cerramiento ? 'Con cerramiento' : 'Sin cerramiento' }}
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
