<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Restringido - ServiTecNet</title>
    <style>
        body { 
            background-color: #111; 
            color: white; 
            font-family: 'Segoe UI', Tahoma, sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .login-box { 
            background: #222; 
            padding: 40px; 
            border-radius: 10px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
            text-align: center; 
            width: 100%; 
            max-width: 350px; 
        }
        .login-box h2 { color: #0d47a1; margin-bottom: 5px; }
        .login-box p { color: #aaa; font-size: 14px; margin-bottom: 25px; }
        .pin-input { 
            width: 100%; 
            padding: 15px; 
            font-size: 24px; 
            text-align: center; 
            letter-spacing: 5px; 
            border: 2px solid #333; 
            background: #111; 
            color: white; 
            border-radius: 5px; 
            margin-bottom: 20px; 
            box-sizing: border-box;
        }
        .pin-input:focus { outline: none; border-color: #0d47a1; }
        .btn-submit { 
            background: #0d47a1; 
            color: white; 
            border: none; 
            padding: 15px; 
            width: 100%; 
            font-size: 16px; 
            font-weight: bold; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: 0.3s;
        }
        .btn-submit:hover { background: #1565c0; }
        .error-msg { color: #ff5252; margin-bottom: 15px; font-size: 14px; }
    /* --- RESPONSIVIDAD (CELULARES Y TABLETS) --- */
        @media (max-width: 768px) {
            /* --- 1. ARREGLO DE LOS TEXTOS GIGANTES --- */
    h1, .hero h1, .seccion-inicio h1 {
        font-size: 1.8rem !important; /* Reduce drásticamente el tamaño del título */
        line-height: 1.2 !important;
        padding: 0 10px !important;
        margin-bottom: 10px !important;
    }

    p, .hero p, .seccion-inicio p {
        font-size: 0.9rem !important; /* Reduce el subtítulo */
        line-height: 1.4 !important;
        padding: 0 15px !important;
    }

    /* --- 2. ARREGLO DE LA BARRA DE NAVEGACIÓN (NAVBAR) --- */
    header, nav, .navbar { 
        display: flex !important;
        flex-direction: column !important; /* Pone el logo arriba del menú */
        align-items: center !important;
        padding: 15px 0 !important;
        height: auto !important;
        background-color: rgba(0, 0, 0, 0.9) !important; /* Fondo más oscuro para que se lea */
    }
    
    header ul, nav ul, .nav-links {
        display: flex !important;
        flex-direction: column !important; /* Apila los enlaces uno debajo del otro */
        width: 100% !important;
        gap: 12px !important;
        margin-top: 15px !important;
        padding: 0 !important;
    }
    
    header ul li, nav ul li {
        width: 100% !important;
        text-align: center !important;
        display: block !important;
    }

    header ul li a, nav ul li a, .nav-links a {
        display: block !important;
        font-size: 1rem !important; /* Tamaño de letra legible para dedos */
        padding: 8px !important;
    }
    
    .chat-btn, .btn-whatsapp-flotante {
        width: 55px;
        height: 55px;
        bottom: 15px;
    }
            /* Reduce los márgenes excesivos en pantallas pequeñas */
            .form-card {
                padding: 25px 20px;
                border-radius: 12px;
            }

            .form-header h2 {
                font-size: 1.6rem;
            }

            /* Apila los botones de forma vertical para facilitar el toque (Touch UX) */
            .form-actions {
                flex-direction: column;
                gap: 12px;
                margin-top: 20px;
            }

            .btn-cancel, 
            .btn-submit {
                width: 100%;
                padding: 14px;
            }
            
            /* Sube el botón principal de 'Guardar' por encima del de 'Cancelar' */
            .btn-submit {
                order: -1; 
            }
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Inicia sesión</h2>
        <p>Ingrese sus Credenciales de seguridad para continuar</p>

        @if(session('error'))
            <div class="error-msg">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.verify') }}" method="POST">
            @csrf <input type="email" name="email" class="pin-input" required placeholder="Correo electronico" style="font-size: 16px; letter-spacing: normal;">
            <input type="password" name="password" class="pin-input" required placeholder="Contraseña" style="font-size: 16px; letter-spacing: normal;">
            <!-- Botón de Iniciar Sesión con Google -->
<div style="margin-top: 20px; text-align: center;">
    <a href="{{ route('google.login') }}" style="display: inline-flex; align-items: center; gap: 10px; background-color: #ffffff; color: #333; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #ddd;">
        <img src="https://fonts.gstatic.com/s/i/productlogos/googleg/v6/24px.svg" alt="Google Logo" style="width: 20px; height: 20px;">
        Continuar con Google
    </a>
</div>
            <button type="submit" class="btn-submit">ENTRAR AL SISTEMA</button>
        </form>
    </div>

</body>
</html>