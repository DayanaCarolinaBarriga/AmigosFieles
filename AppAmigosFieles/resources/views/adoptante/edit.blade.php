@extends('tablar::page')

@section('title', 'Actualizar Adoptante')

@section('content')
    <!-- Encabezado de la página -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Subtítulo de la página -->
                    <div class="page-pretitle">
                        Editar
                    </div>
                    <h2 class="page-title">
                        {{ __('Actualizar Adoptante') }}
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
            @if(config('tablar', 'display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles del Adoptante</h3>
                        </div>
                        <div class="card-body">
                            <!-- Formulario con AJAX -->
                            <form method="POST"
                                  action="{{ route('adoptantes.update', $adoptante->id) }}" 
                                  id="ajaxForm" 
                                  role="form"
                                  enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf

                                <!-- Incluye el formulario -->
                                @include('adoptante.form')

                                <!-- Botón de envío -->
                                <div class="form-footer">
                                    <div class="text-end">
                                        <div class="d-flex">
                                            <a href="{{ route('adoptantes.index') }}" class="btn btn-danger">Cancelar</a>
                                            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Actualizar Adoptante</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Script para enviar formulario con AJAX -->
    <script>
        $(document).ready(function () {
            $('#ajaxForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Acción en caso de éxito
                        if(response.status === 'success') {
                            window.location.href = '{{ route('adoptantes.index') }}'; // Redirigir a la lista de adoptantes
                        } else {
                            alert('Hubo un problema al actualizar el adoptante.');
                        }
                    },
                    error: function (error) {
                        // Acción en caso de error
                        alert('Error en el envío del formulario.');
                    }
                });
            });
        });
    </script>
@endpush
