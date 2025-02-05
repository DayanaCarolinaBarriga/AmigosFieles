<div class="volunteer-page">
    <div class="content-wrapper">
        <h1>👋 ¡Únete al Voluntariado!</h1>
        
        <div class="volunteer-info">
            <p>✨ El voluntariado es el corazón de nuestra fundación. Colabora con nosotros en actividades locales, nacionales e internacionales. Ya sea por un día o a largo plazo, tu tiempo hace la diferencia. ✨</p>
            
            <p>📢 Ofrecemos pasantías para estudiantes universitarios y espacios para quienes deseen contribuir según sus posibilidades.</p>
            
            <p>🐶 Nuestros perritos te agradecerán cada momento que compartas con ellos o ayudando a mejorar su hogar temporal. 🐾</p>
        </div>

        <div class="contact-button">
            <a href="https://wa.me/593939465219"class="btn-volunteer">Contáctanos y sé parte del cambio</a>
        </div>

        <div class="image-gallery">
            <div class="gallery-item">
                <img src="https://amigosfieles.org/wp-content/uploads/2021/11/KampagneShell-1536x1152.jpg" alt="Voluntarios trabajando">
            </div>
            <div class="gallery-item">
                <img src="https://amigosfieles.org/wp-content/uploads/2021/11/20200308_132147-768x576.jpg" alt="Actividades voluntarias">
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --dark-green: #2E7D32;
    }

    .volunteer-page h1 {
        background-color: var(--dark-green);
        color: white;
        padding: 15px 20px;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 25px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

.volunteer-page {
    padding: 40px 20px;
    background-color: #eaf4f4;
    min-height: 100vh;
    font-family: 'Arial', sans-serif;
}

.content-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}



.volunteer-info p {
    line-height: 1.8;
    color: #4a4a4a;
    margin-bottom: 20px;
    font-size: 1.1rem;
}

.contact-button {
    text-align: center;
    margin: 30px 0;
}

.btn-volunteer {
    background-color:rgb(43, 163, 29);
    color: white;
    padding: 15px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-size: 1.2rem;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-volunteer:hover {
    background-color:rgb(22, 173, 87);
    transform: scale(1.05);
}

.image-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 40px;
}

.gallery-item {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-10px);
}

@media (max-width: 768px) {
    .content-wrapper {
        padding: 20px;
    }

    .content-wrapper h1 {
        font-size: 2rem;
    }

    .btn-volunteer {
        font-size: 1rem;
        padding: 10px 20px;
    }
}
</style>
