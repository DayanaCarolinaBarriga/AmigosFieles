<div class="donations-page">
    <div class="content-wrapper">
        <h1>Donaciones</h1>
        <p>Tu apoyo es fundamental para continuar con nuestra labor de rescate y cuidado animal.</p>
        <p>No contamos con ningún financiamiento fijo de fondos públicos o privados. Para poder ayudar a los animalitos necesitados dependemos de la ayuda económica de la ciudadanía.
        </p>
        <div class="donation-methods">
            <div class="donation-card">
                <h2>💳 Transferencia Bancaria</h2>
                <ul>
                    <li><strong>Banco:</strong> Pichincha</li>
                    <li><strong>Cuenta de Ahorros:</strong> 2206948617</li>
                    <li><strong>Titular:</strong> Fundación Amigos Fieles</li>
                    <li><strong>RUC:</strong> 691727196001</li>
                </ul>
            </div>

            <div class="donation-card">
                <h2>🌟 Donaciones Materiales</h2>
                <ul>
                    <li>Alimento para perros y gatos</li>
                    <li>Medicinas veterinarias</li>
                    <li>Materiales de limpieza</li>
                    <li>Cobijas y camas</li>
                </ul>
            </div>
        </div>
        <div class="donation-footer">
            <button class="donate-button">Contáctanos para donar</button>
        </div>
    </div>
</div>

<style>
.donations-page {
    padding: 40px 20px;
    background-color: #f0f4f8;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.content-wrapper {
    max-width: 900px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.content-wrapper h1 {
    color: #2c3e50;
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.content-wrapper p {
    color: #555;
    font-size: 1.2rem;
    margin-bottom: 40px;
}

.donation-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.donation-card {
    background:rgb(102, 210, 66);
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.donation-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}

.donation-card h2 {
    color: #007bff;
    margin-bottom: 15px;
    font-size: 1.6rem;
}

.donation-card ul {
    list-style: none;
    padding: 0;
}

.donation-card li {
    margin-bottom: 10px;
    color: #34495e;
    font-size: 1rem;
}

.donation-footer {
    margin-top: 40px;
}

.donate-button {
    background-color:rgb(43, 163, 29);
    color: white;
    border: none;
    padding: 15px 30px;
    font-size: 1.2rem;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.donate-button:hover {
    background-color:rgb(22, 173, 87);
}

@media (max-width: 768px) {
    .content-wrapper {
        padding: 20px;
    }
    
    .donation-methods {
        grid-template-columns: 1fr;
    }
}

:root {
    --dark-green: #2E7D32;
}

.donations-page h1 {
    background-color: var(--dark-green);
    color: white;
    padding: 15px;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 20px;
}
</style>
