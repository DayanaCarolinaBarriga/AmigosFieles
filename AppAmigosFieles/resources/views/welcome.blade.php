<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AMIGOS FIELES</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            html{line-height:1.15;-webkit-text-size-adjust:100%}
            body{margin:0}
            a{background-color:transparent}
            [hidden]{display:none}
            html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}
            *,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}
            a{color:inherit;text-decoration:inherit}
            svg,video{display:block;vertical-align:middle}
            video{max-width:100%;height:auto}
            .bg-white{background-color:#fff}
            .text-center{text-align:center}
            .mx-auto{margin-left:auto;margin-right:auto}
            .min-h-screen{min-height:100vh}
            .flex{display:flex}
            .items-center{align-items:center}
            .justify-center{justify-content:center}
            body {
                font-family: 'Nunito';
            }
            /* Contenedor principal */
            .container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                padding: 0 1rem;
                position: relative;
                overflow: hidden; /* Evita el desbordamiento de la imagen */
            }
            /* Contenedor de la imagen */
            .image-container {
                width: 100%; /* Ocupa el 100% del contenedor */
                height: 80%; /* Ajusta la altura de la imagen */
                max-width: 600px; /* Limita el ancho máximo */
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
            }
            .image-container img {
                width: 100%; /* La imagen ocupa el 100% del ancho del contenedor */
                height: 100%; /* La imagen ocupará todo el alto disponible */
                object-fit: contain; /* Mantiene la imagen proporcional y la ajusta sin recortar */
            }
            /* Estilo de los botones */
            .buttons-container {
                position: absolute;
                top: 20px;
                left: 20px;
                z-index: 10; /* Asegura que los botones estén encima de la imagen */
                display: flex;
                gap: 15px; /* Espacio entre los botones */
            }
            .buttons-container a {
                font-size: 20px;
                font-weight: bold;
                color: white;
                background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro con transparencia */
                padding: 12px 20px;
                border-radius: 5px;
                text-decoration: none;
                transition: background-color 0.3s;
            }
            .buttons-container a:hover {
                background-color: rgba(0, 0, 0, 0.7); /* Efecto de hover */
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container">
            @if (Route::has('login'))
                <div class="buttons-container">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Iniciar Sesion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Registrarse</a>
                        @endif
                    @endif
                </div>
            @endif

            <!-- Contenedor para centrar la imagen -->
            <div class="image-container">
                <img src="https://th.bing.com/th/id/OIP.7WFdydWkhJkfJI-FkAfrpAAAAA?rs=1&pid=ImgDetMain" alt="Imagen Central">
            </div>
        </div>
    </body>
</html>
