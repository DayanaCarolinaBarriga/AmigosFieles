<!-- home.blade.php -->
@extends('tablar::page')

@section('content')
<!-- Fullscreen Background Section -->
<div 
    class="position-relative min-vh-100 bg-cover text-white d-flex justify-content-center align-items-center" 
    style="background-image: url('https://th.bing.com/th/id/R.089b1c3c092219d2f34e808ca2903b96?rik=zOawhv1Wky1NjQ&pid=ImgRaw&r=0'); background-size: cover; background-position: center; background-attachment: fixed;">
    
    <!-- Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6);"></div>

    <!-- Content -->
    <div class="position-relative text-center">
        <div class="mb-4">
            <img src="https://amigosfieles.org/wp-content/uploads/2021/07/logo-small-negro.png" 
                 alt="Amigos Fieles Logo" 
                 class="img-fluid" 
                 style="max-width: 200px; height: auto;">
        </div>

        <h1 class="display-3 fw-bold text-white mb-3" style="text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);">
            ¡Bienvenido a Amigos Fieles! 🐾
        </h1>
        <p class="lead text-white-50" style="text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.8);">
            La plataforma ideal para gestionar y cuidar a nuestros amigos animales.
        </p>
    </div>
</div>

<!-- Statistics Section -->
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Animales</h5>
                    <h2>{{ $totalAnimales }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Disponibles</h5>
                    <h2>{{ $animalesDisponibles }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Adoptados este mes</h5>
                    <h2>{{ $adoptadosMes }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Gastos del mes</h5>
                    <h2>${{ number_format($gastosMes, 2) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Animales por Especie</h5>
                    <canvas id="especiesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Adopciones por Mes</h5>
                    <canvas id="adopcionesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('especiesChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($especiesLabels) !!},
            datasets: [{
                data: {!! json_encode($especiesValues) !!},
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#FF9F40']
            }]
        }
    });

    new Chart(document.getElementById('adopcionesChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($mesesLabels) !!}, // Nombres de los meses
            datasets: [{
                label: 'Adopciones',
                data: {!! json_encode($adopcionesData) !!},
                backgroundColor: '#36A2EB'
            }]
        }
    });
</script>
@endsection
