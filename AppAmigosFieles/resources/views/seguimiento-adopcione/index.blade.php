@extends('tablar::page')

@section('title')
    Seguimiento Adopciones
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
                        {{ __('Seguimiento Adopciones') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('seguimientoadopcione.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Registar Seguimiento
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Seguimientos</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Adopción</th>
                                        <th>Seguimiento</th>
                                        <th>Comentario</th>
                                        <th>Apto</th>
                                        <th>Retiro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @forelse ($seguimientos as $seguimiento)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
                                            <!-- Mostrar Nombre del Animal, Nombre del Adoptante y Fecha de Adopción -->
                                            <td>
                                                {{ $seguimiento->adopcion->animale->nombre ?? 'Desconocido' }} - 
                                                {{ $seguimiento->adopcion->adoptante->nombre ?? 'Desconocido' }} - 
                                                {{ $seguimiento->adopcion->fecha_adopcion ?? 'Desconocida' }}
                                            </td>
                                            <td>{{ $seguimiento->seguimiento ? 'Sí' : 'No' }}</td>
                                            <td>{{ $seguimiento->comentario_seguimiento }}</td>
                                            <td>{{ $seguimiento->apto ? 'Sí' : 'No' }}</td>
                                            <td>{{ $seguimiento->retiro_adopcion ? 'Sí' : 'No' }}</td>
                                            <td>
                                                <a href="{{ route('seguimientoadopcione.show', $seguimiento->id) }}" class="btn btn-info btn-sm">Ver</a>
                                                <a href="{{ route('seguimientoadopcione.edit', $seguimiento->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('seguimientoadopcione.destroy', $seguimiento->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="if(!confirm('¿Quieres proceder?')){return false;}">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No se encontraron Datos</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {!! $seguimientos->links('tablar::pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
