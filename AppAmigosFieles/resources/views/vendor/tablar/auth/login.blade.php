@extends('tablar::auth.layout')
@section('title', 'Login')
@section('content')
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .full-background {
            background-image: url('https://amigosfieles.org/wp-content/uploads/2021/09/Raisa2-e1632494814868-768x577.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
    </style>

    <div class="full-background">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="" class="navbar-brand navbar-brand-autodark">
                    <img src="https://amigosfieles.org/wp-content/uploads/2021/07/logo-small-negro.png" height="80" alt="">
                </a>
            </div>
            <div class="card card-md p-4">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Ingresa a tu cuenta</h2>
                    <form action="{{ route('login') }}" method="post" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                   placeholder="tu@email.com"
                                   autocomplete="off">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Contraseña
                                <span class="form-label-description">
                                    <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                                </span>
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="tu contraseña"
                                       autocomplete="off">
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Mostrar contraseña" data-bs-toggle="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                             <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                             <circle cx="12" cy="12" r="2"/>
                                             <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7
                                                      c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/>
                                        </svg>
                                    </a>
                                </span>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input"/>
                                <span class="form-check-label">Recuerda este dispositivo</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3" style="color: #000 !important;">
                ¿No tienes cuenta? <a href="{{ url('/') }}" tabindex="-1">Regresar</a>
            </div>

        </div>
    </div>
@endsection

