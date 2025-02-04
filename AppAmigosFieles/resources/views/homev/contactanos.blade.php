<div class="contact-page">
    <div class="content-wrapper">
        <h1>📞 ¡Contáctanos!</h1>
        
        <div class="contact-info">
            <p>🏡 <strong>Dirección:</strong> Ciudad de Puyo, Provincia de Pastaza, Barrio Tarqui.</p>
            
            <p>💬 <strong>Síguenos en nuestras redes sociales:</strong></p>
            <div class="social-links">
                <a href="https://www.facebook.com/fundacionamigosfieles.puyo" target="_blank" class="social-icon facebook">
                    <img src="https://cdn-icons-png.flaticon.com/128/733/733547.png" alt="Facebook" class="social-icon-img"> Facebook
                </a>
                <a href="https://www.instagram.com/fundacionamigosfieles/?hl=en" target="_blank" class="social-icon instagram">
                    <img src="https://cdn-icons-png.flaticon.com/128/3955/3955024.png" alt="Instagram" class="social-icon-img"> Instagram
                </a>
            </div>

            <p>🌟 En nuestra fundación, cada acción cuenta. Ya sea para donar, ser voluntario o simplemente conocer más, estamos aquí para ayudarte y hacer del mundo un lugar mejor para nuestros amigos peludos. 🐾</p>
        </div>

        <div class="contact-image">
            <img src="https://amigosfieles.org/wp-content/uploads/2021/06/voluntarios-768x638.jpg" alt="Voluntarios trabajando">
        </div>

        <div class="contact-button">
            <!-- Enlace a WhatsApp con tu número -->
            <a href="https://wa.me/593939465219" class="btn-contact">¡Haz la diferencia, contáctanos ahora!</a>
        </div>
    </div>
</div>

<style>
    :root {
        --dark-green: #2E7D32;
    }

    .contact-page h1 {
        background-color: var(--dark-green);
        color: white;
        padding: 20px 30px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 25px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        font-size: 2.5rem;
    }

    .contact-page {
        padding: 50px 20px;
        background-color: #f5f7f7;
        min-height: 100vh;
        font-family: 'Arial', sans-serif;
    }

    .content-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        text-align: center;
    }

    .contact-info p {
        line-height: 1.8;
        color: #4a4a4a;
        margin-bottom: 20px;
        font-size: 1.2rem;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .social-icon {
        background-color: var(--dark-green);
        color: white;
        padding: 15px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .social-icon-img {
        width: 24px;
        height: 24px;
        margin-right: 10px;
    }

    .social-icon:hover {
        background-color: rgb(22, 173, 87);
        transform: scale(1.05);
    }

    .contact-image {
        margin-top: 30px;
        text-align: center;
    }

    .contact-image img {
        width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .contact-button {
        text-align: center;
        margin: 40px 0;
    }

    .btn-contact {
        background-color: rgb(43, 163, 29);
        color: white;
        padding: 15px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-size: 1.4rem;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-contact:hover {
        background-color: rgb(22, 173, 87);
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 20px;
        }

        .content-wrapper h1 {
            font-size: 2rem;
        }

        .btn-contact {
            font-size: 1.2rem;
            padding: 12px 25px;
        }

        .social-icon {
            font-size: 1rem;
            padding: 12px 20px;
        }

        .contact-info p {
            font-size: 1rem;
        }
    }
</style>
