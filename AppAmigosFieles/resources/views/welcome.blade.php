<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundación Amigos Fieles</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset de estilos */
        body, html { 
            margin: 0; 
            padding: 0; 
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
        }
        * { box-sizing: border-box; }
        
        body {
            background-image: url('https://amigosfieles.org/wp-content/uploads/2021/09/MambruN1L23-e1632491252435-768x576.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color:rgb(250, 244, 244);
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(243, 234, 234, 0.3); /* Reducida para ver mejor la imagen */
            z-index: 0;
        }

        .navegacion, #contenido-principal {
            position: relative;
            z-index: 1;
        }

        /* Estilos del menú */
        .navegacion {
            background-color: rgba(95, 192, 26, 0.9);
            padding: 1rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            position: sticky;
            top: 0;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-link {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: background 0.3s ease, color 0.3s ease;
            border-radius: 8px;
        }

        .nav-link:hover {
            background: #3cb371;
        }

        .nav-link.active {
            background:rgb(125, 200, 26);
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }
        }

        /* Estilos de las secciones */
        .section {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            margin: 40px auto;
            padding: 50px;
            max-width: 1200px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .main-content {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .content-text {
            flex: 1;
        }

        .main-title {
            color: #228b22;
            font-size: 2.8em;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .subtitle {
            font-size: 1.6em;
            color: #555;
            margin-bottom: 10px;
        }

        .highlight {
            font-size: 1.3em;
            color: #3cb371;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .description {
            font-size: 1.1em;
            line-height: 1.8;
            color: #333;
            text-align: justify;
        }

        .logo-container {
            flex: 0 0 350px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-image {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .btn {
            background-color: #228b22;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #32cd32;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column-reverse;
                text-align: center;
            }

            .logo-container {
                margin-bottom: 20px;
            }

            .description {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <!-- Menú de navegación -->
    <nav class="navegacion">
        <div class="nav-container">
            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Inicio</a>
            <a href="{{ url('/homev/animales') }}" class="nav-link">Mascotas</a>
            <a href="{{ url('/homev/donaciones') }}" class="nav-link">Donaciones</a>
            <a href="{{ url('/homev/voluntariado') }}" class="nav-link">Voluntariado</a>
            <a href="{{ url('/homev/contactanos') }}" class="nav-link">Contáctanos</a>
            <a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }}">Iniciar Sesión</a>
            
        </div>
    </nav>

    <!-- Sección de Inicio -->
    <div class="section" id="contenido-principal">
        @if(isset($content))
            @include($content)
        @else
            <div class="main-content">
                <div class="logo-container">
                    <img src="https://amigosfieles.org/wp-content/uploads/2021/07/logo-small-negro.png" alt="Logo de Amigos Fieles" class="logo-image">
                </div>
                <div class="content-text">
                    <h1 class="main-title">Fundación de Protección y Rescate Animal Amigos Fieles</h1>
                    <div class="subtitle">Organización sin fines de lucro</div>
                    
                    <p class="description">Somos una fundación dedicada al rescate, la rehabilitación y el cuidado de animales abandonados y en situaciones de riesgo. Los perros rescatados pasan su tiempo de recuperación en nuestro refugio canino o en hogares temporales para posteriormente ser ubicados en hogares adoptantes.</p>
                   
                </div>
            </div>
        @endif
    </div>

</body>
</html>
