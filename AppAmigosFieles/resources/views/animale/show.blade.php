@extends('tablar::page')

@section('title', 'Ver Animal')

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
                        {{ __('Animales') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('animales.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Lista de Animales
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
                    @if(config('tablar.display_alert'))
                        @include('tablar::common.alert')
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles del Animal</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <strong>Nombre:</strong>
                                {{ $animale->nombre }}
                            </div>
                            <div class="form-group">
                                <strong>Especie:</strong>
                                {{ $animale->especie->especie }} 
                            </div>
                            <div class="form-group">
                                <strong>Sexo:</strong>
                                {{ $animale->sexo }}
                            </div>
                            <div class="form-group">
                                <strong>Fecha de Nacimiento:</strong>
                                {{ \Carbon\Carbon::parse($animale->fecha_nacimiento)->format('d/m/Y') }}
                            </div>
                            <div class="form-group">
                                <strong>Fecha de Ingreso:</strong>
                                {{ \Carbon\Carbon::parse($animale->fecha_ingreso)->format('d/m/Y') }}
                            </div>
                            <div class="form-group">
                                <strong>Estado:</strong>
                                {{ $animale->estado }}
                            </div>
                            <!-- Mostrar Esterilizado como "Sí" o "No" -->
                            <div class="form-group">
                                <strong>Esterilizado:</strong>
                                @if($animale->esterilizado == 1)
                                    Sí
                                @else
                                    No
                                @endif
                            </div>
                            
                            <!-- Mostrar imagen si existe -->
                            <div class="form-group">
                                <strong>Foto:</strong>
                                @if($animale->foto_path) <!-- Asegúrate de que aquí se llama 'foto_path' -->
                                    <img src="{{ asset('storage/' . $animale->foto_path) }}" alt="Foto del Animal" class="img-fluid mt-2" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                @else
                                    <p>No se ha subido una imagen.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
