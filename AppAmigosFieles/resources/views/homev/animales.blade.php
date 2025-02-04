<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animales Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-green: #4CAF50;
            --light-green: #8BC34A;
            --dark-green: #2E7D32;
            --pale-green:rgb(68, 171, 76);
            --green-100: #e8f5e9;
            --green-200: #c8e6c9;
            --green-300: #a5d6a7;
            --green-400: #81c784;
            --green-500: #4caf50;
        }

        body {
            background-color: var(--green-100);
        }

        .btn {
            background-color: var(--primary-green) !important;
            border-color: var(--primary-green) !important;
            color: white !important;
        }

        .btn:hover {
            background-color: var(--dark-green) !important;
            border-color: var(--dark-green) !important;
        }

        .card {
            background-color: var(--green-200);
            border-color: var(--green-400);
        }

        .navbar {
            background-color: var(--dark-green) !important;
        }

        .table {
            background-color: white;
            border: 1px solid var(--light-green);
        }

        .thead {
            background-color: var(--primary-green);
            color: white;
        }

        .alert-info {
            background-color: var(--green-300);
            border-color: var(--green-500);
            color: #1b5e20;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--green-500);
            border-color: var(--green-500);
        }

        .pagination .page-link {
            color: var(--green-500);
        }

        .btn-primary {
            background-color: var(--green-500);
            border-color: var(--green-500);
        }

        .btn-primary:hover {
            background-color: #388e3c;
            border-color: #388e3c;
        }

        body {
            background-color:rgb(103, 203, 36);
        }
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-secondary, .btn-primary {
            border-radius: 10px;
        }
        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .form-label {
            font-weight: bold;
        }
        h1 {
            font-size: 2.5rem;
            color: #333;
        }

        .title-section {
            background-color: var(--dark-green);
            color: white;
            padding: 1rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        h1, h2, h3 {
            color: white;
            background-color: var(--dark-green);
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Botón Volver -->
        <div class="text-start mb-4">
            <a href="{{ url('/') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <h1 class="text-center mb-4">Animales Disponibles para Adopción</h1>

        <!-- Filtros -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ url('/homev/animales') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ request('nombre') }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Especie</label>
                            <select name="especie" class="form-select">
                                <option value="">Todas las especies</option>
                                @isset($especies)
                                    @foreach($especies as $especie)
                                        <option value="{{ $especie->id }}" {{ request('especie') == $especie->id ? 'selected' : '' }}>
                                            {{ $especie->especie }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Esterilizado</label>
                            <select name="esterilizado" class="form-select">
                                <option value="">Todos</option>
                                <option value="1" {{ request('esterilizado') == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ request('esterilizado') == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Sexo</label>
                            <select name="sexo" class="form-control">
                                <option value="">Todos</option>
                                <option value="macho" {{ request('sexo') == 'macho' ? 'selected' : '' }}>Macho</option>
                                <option value="hembra" {{ request('sexo') == 'hembra' ? 'selected' : '' }}>Hembra</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Edad Mínima (años)</label>
                            <input type="number" name="edad_min" class="form-control" min="0" max="30" value="{{ request('edad_min') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Edad Máxima (años)</label>
                            <input type="number" name="edad_max" class="form-control" min="0" max="30" value="{{ request('edad_max') }}">
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Filtrar</button>
                        <a href="{{ url('/homev/animales') }}" class="btn btn-secondary px-4">Limpiar</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de Animales -->
        @isset($animales)
            @if($animales->count() > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($animales as $animal)
                        <div class="col">
                            <div class="card h-100">
                                @if($animal->foto_path)
                                    <img src="{{ asset('storage/' . $animal->foto_path) }}" class="card-img-top" alt="{{ $animal->nombre }}">
                                @else
                                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Sin imagen">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $animal->nombre }}</h5>
                                    <p class="card-text">
                                        <strong>Especie:</strong> {{ $animal->nombre_especie ?? $animal->especie->especie }}<br>
                                        <strong>Sexo:</strong> {{ $animal->sexo == 'macho' ? 'macho' : 'hembra' }}<br>
                                        <strong>Edad:</strong> 
                                        @if($animal->fecha_nacimiento)
                                            {{ \Carbon\Carbon::parse($animal->fecha_nacimiento)->age }} años <br>
                                        @else
                                            No registrado <br>
                                        @endif
                                        <strong>Esterilizado:</strong> {{ $animal->esterilizado ? 'Sí' : 'No' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $animales->links() }}
                </div>
            @else
                <div class="alert alert-info text-center" role="alert">
                    No se encontraron animales que coincidan con los criterios de búsqueda.
                </div>
            @endif
        @endisset
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
