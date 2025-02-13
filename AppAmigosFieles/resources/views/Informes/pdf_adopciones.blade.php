<!DOCTYPE html>
<html>
<head>
    <title>Informe de Adopciones</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; color: #333; }
        .header { margin-bottom: 30px; }
        .fecha { text-align: right; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Informe de Adopciones</h1>
        <div class="fecha">Fecha: {{ date('d/m/Y') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Animal</th>
                <th>Adoptante</th>
                <th>Estado</th>
                <th>Fecha Adopción</th>
                <th>Visita Previa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adopciones as $adopcion)
                <tr>
                    <td>{{ $adopcion->id }}</td>
                    <td>{{ $adopcion->animale->nombre }}</td>
                    <td>{{ $adopcion->adoptante->nombre }}</td>
                    <td>{{ $adopcion->estado_proceso }}</td>
                    <td>{{ $adopcion->fecha_adopcion }}</td>
                    <td>{{ $adopcion->visita_previa ? 'Sí' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>