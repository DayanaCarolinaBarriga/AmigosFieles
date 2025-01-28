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
            <!-- Logo -->
            <div class="mb-4">
                <img src="https://amigosfieles.org/wp-content/uploads/2021/07/logo-small-negro.png" 
                     alt="Amigos Fieles Logo" 
                     class="img-fluid" 
                     style="max-width: 200px; height: auto;">
            </div>

            <!-- Welcome Text -->
            <h1 class="display-3 fw-bold text-white mb-3" style="text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);">
                ¡Bienvenido a Amigos Fieles! 🐾
            </h1>
            <p class="lead text-white-50" style="text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.8);">
                La plataforma ideal para gestionar y cuidar a nuestros amigos animales.
            </p>
            
            <!-- Button -->
           
        </div>
    </div>
@endsection
