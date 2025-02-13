@extends('tablar::page')

@section('title', 'Ver Visitas Seguimiento')

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
                        {{ __('Visitas Seguimiento ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('visitasseguimiento.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Visitas Seguimiento List
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
                    @if(config('tablar','display_alert'))
                        @include('tablar::common.alert')
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Visitas Seguimiento Details</h3>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <strong>Visita de la adopcion(Animal-Adoptante):</strong>
                            {{ $visitasSeguimiento->seguimientoAdopcione->adopcion->animale->nombre ?? 'Desconocido' }} - 
                            {{ $visitasSeguimiento->seguimientoAdopcione->adopcion->adoptante->nombre ?? 'Desconocido' }} -
                            {{ $visitasSeguimiento->seguimientoAdopcione->adopcion->fecha_adopcion ?? 'Sin fecha' }}
                        </div>
                            <div class="form-group">
                                <strong>¿Se realizó la visita?:</strong>
                                {{ $visitasSeguimiento->visita ? 'Si' : 'No' }}
                            </div>
                            <div class="form-group">
                            <strong>Fecha Visita:</strong>
                            {{ $visitasSeguimiento->fecha_visita }}
                            </div>
                            <div class="form-group">
                            <strong>Comentario:</strong>
                            {{ $visitasSeguimiento->comentario }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


