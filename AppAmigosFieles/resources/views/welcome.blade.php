<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundación Amigos Fieles</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Reset de estilos */
        body, html { margin: 0; padding: 0; font-family: 'Nunito', sans-serif; }
        * { box-sizing: border-box; }
        .bg-gray { background-color: #f7fafc; }

        /* Estilos del menú */
        nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #333;
            color: white;
            padding: 10px 0;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 10px;
            transition: background-color 0.3s ease;
        }
        nav a:hover {
            background-color: #555;
        }

        /* Estilos de las secciones */
        .section {
            padding: 20px;
            text-align: center;
        }

        .section img {
            width: 100%;
            max-width: 400px;
            margin-top: 20px;
        }

        .donations, .volunteers {
            background-color: #f4f4f4;
            margin-top: 20px;
        }

        /* Estilo para los botones */
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Menú de navegación -->
    <nav>
        <a href="/">Inicio</a>
        <a href="#mascotas">Mascotas</a>
        <a href="#donaciones">Donaciones</a>
        <a href="#voluntariado">Voluntariado</a>
        <a href="/login">Iniciar Sesión</a>
        <a href="#contactanos">Contáctanos</a>
    </nav>

    <!-- Sección de Inicio -->
    <div class="section" id="inicio">
        <h1>Fundación de Protección y Rescate Animal Amigos Fieles</h1>
        <p>Organización sin fines de lucro</p>
        <p>Refugio canino y centro de esterilizaciones para perros y gatos</p>
        <p>Somos una fundación dedicada al rescate, la rehabilitación y el cuidado de animales abandonados y en situaciones de riesgo. Los perros rescatados pasan su tiempo de recuperación en nuestro refugio canino o en hogares temporales para posteriormente ser ubicados en hogares adoptantes.</p>
        <img src="https://amigosfieles.org/wp-content/uploads/2021/06/logo-vertical.png" alt="Logo de Amigos Fieles">
    </div>

    <!-- Sección de Donaciones -->
    <div class="section donations" id="donaciones">
        <h2>Ayudar y Donar</h2>
        <p>Nuestra labor de rescate, rehabilitación, alimentación y cuidados de los perros depende de sus donaciones.</p>
        <p>No contamos con ningún financiamiento fijo de fondos públicos o privados. Para poder ayudar a los animalitos necesitados dependemos de la ayuda económica de la ciudadanía.</p>
        <p>Los gastos en atención médica son altos ya que muchos perros llegan en mal estado de salud y necesitan tratamientos o cirugías costosas.</p>
        <p>Nuestra campaña de esterilización con funcionamiento permanente nos permite ofrecer un bienestar animal sostenible y garantizar una solución a largo plazo para reducir la reproducción descontrolada de perros y gatos.</p>
        <h3>Cuentas para Donativos:</h3>
        <p>Fundación Amigos Fieles</p>
        <p>Bco. Pichincha | Cta. de Ahorros # 2206948617</p>
        <p>CAPCE | Cta. de Ahorros # 1701100010139637</p>
        <p>RUC: 1691727196001</p>
        <a href="https://www.gofundme.com" class="btn" target="_blank">Crowdfunding con GoFundMe</a>
    </div>

    <!-- Sección de Voluntariado -->
    <div class="section volunteers" id="voluntariado">
        <h2>Voluntariado</h2>
        <p>El voluntariado es un elemento clave del trabajo de nuestra fundación. Trabajamos con voluntarios locales, nacionales e internacionales. Los voluntarios se pueden integrar en acciones puntuales como una minga en el refugio, por el tiempo de semanas, meses o de forma permanente. Valoramos la voluntad de cada persona de involucrarse según sus posibilidades. También ofrecemos pasantías para estudiantes universitarios.</p>
        <p>Si quieres formar parte activa de nuestra labor, comunícate con nosotros por correo electrónico, teléfono o WhatsApp.</p>
        <p>Nuestros perritos te agradecen el tiempo que les dedicas a ellos o a la infraestructura del refugio, que es esencial para que puedan tener una vida digna mientras están con nosotros.</p>
    </div>

    <!-- Sección de Iniciar Sesión -->
    <div class="section" id="login">
        <a href="/login" class="btn">Iniciar Sesión</a>
    </div>

    <!-- Sección de Contacto -->
    <div class="section" id="contactanos">
        <h2>Contáctanos</h2>
        <p>¡Estamos aquí para ayudarte! Ponte en contacto con nosotros para más información sobre nuestra fundación y cómo puedes ayudar.</p>
        <p>Email: contacto@amigosfieles.org</p>
        <p>Teléfono: +123456789</p>
    </div>

</body>
</html>
