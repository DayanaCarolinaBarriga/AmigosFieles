<!DOCTYPE html>
<html>
<head>

    <title>Informe de Animales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>REFUGIO AMIGOS FIELES</h1>
    <h1>Informe de Animales</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Sexo</th>
                <th>Esterilizado</th>
                <th>Fecha de Ingreso</th>
                <th>Estado</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($animales as $animal)
                <tr>
                    <td>{{ $animal->id }}</td>
                    <td>{{ $animal->nombre }}</td>
                    <td>{{ $animal->nombre_especie }}</td>
                    <td>{{ $animal->sexo }}</td>
                    <td>{{ $animal->esterilizado ? 'Sí' : 'No' }}</td>
                    <td>{{ $animal->fecha_ingreso }}</td>
                    <td>{{ $animal->estado }}</td>
                    <td>{{ $animal->fecha_nacimiento }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>