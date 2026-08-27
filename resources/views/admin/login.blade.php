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
            /* 1. El título y el logo se apilan si no caben */
            .header-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            /* 2. Los botones de arriba y el buscador ocupan todo el ancho */
            .admin-actions {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box input {
                width: 100%;
            }

            /* 3. Las tarjetas pasan a ser de 1 sola columna adaptada al celular */
            .admin-grid {
                grid-template-columns: 1fr;
            }

            /* 4. Dentro de la tarjeta: La foto pasa ARRIBA y el texto ABAJO */
            .card-content {
                flex-direction: column;
            }

            .card-img-container {
                width: 100%;
                height: 180px; /* Altura ideal para la foto en celular */
            }

            .card-info {
                width: 100%;
            }

            /* 5. Los botones de Editar y Eliminar se acomodan mejor */
            .card-buttons {
                flex-wrap: wrap;
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