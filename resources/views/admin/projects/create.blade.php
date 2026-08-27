<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nuevo Proyecto - ServiTecNet</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f7f3e8; /* Mismo fondo crema del dashboard */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .form-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 650px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .form-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .form-header h2 {
            font-size: 2rem;
            color: #4a2f1d;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #666;
            font-size: 0.95rem;
        }

        /* --- Alertas de Error --- */
        .alert-error {
            background-color: #fce8e6;
            color: #c95e46;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 0.9rem;
            border-left: 5px solid #c95e46;
        }
        .alert-error ul {
            margin-left: 20px;
            margin-top: 5px;
        }

        /* --- Estilos de los Inputs --- */
        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #4a2f1d;
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="file"] {
            width: 100%;
            padding: 14px 15px;
            border-radius: 10px;
            border: 2px solid #f2ebe0;
            background-color: #fcfbfa;
            color: #333;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            border-color: #dfc8b4;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(223, 200, 180, 0.2);
        }

        .form-group input[type="file"] {
            padding: 10px;
            background-color: #ffffff;
        }

        /* --- Botones --- */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 35px;
        }

        .btn-cancel {
            flex: 1;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 800;
            color: #4a2f1d;
            background-color: #f2ebe0;
            transition: background-color 0.3s;
        }

        .btn-cancel:hover {
            background-color: #dfc8b4;
        }

        .btn-submit {
            flex: 2;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-weight: 800;
            color: #ffffff;
            background-color: #a45a30;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #8c4b27;
        }
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
            <style>
    .tarjeta-3d {
        position: relative;
        width: 100%;
        height: 300px;
        background-color: #1a1a1a;
        border-radius: 8px 8px 0 0;
        overflow: hidden;
    }

    .img-frontal {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 2; /* Está por encima */
        transition: opacity 0.5s ease; /* Efecto de desvanecimiento suave */
    }

    .modelo-fondo {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1; /* Está por debajo esperando */
    }

    /* La magia: Cuando el mouse pasa por encima de la tarjeta... */
    .tarjeta-3d:hover .img-frontal {
        opacity: 0; /* La imagen se vuelve invisible */
        pointer-events: none; /* Permite que tus clics traspasen hacia el 3D */
    }
    .admin-panel {
        background-color: #1a1a1a;
        padding: 40px;
        border-radius: 8px;
        max-width: 600px;
        margin: 40px auto;
        color: #fff;
        font-family: Arial, sans-serif;
        box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }
    .admin-panel h2 {
        color: #fbc02d;
        text-align: center;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
        color: #ccc;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        background-color: #333;
        border: 1px solid #555;
        color: #fff;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .btn-submit {
        background-color: #fbc02d;
        color: #000;
        font-weight: bold;
        padding: 12px;
        width: 100%;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-transform: uppercase;
    }
    .btn-submit:hover {
        background-color: #fff;
    }
    .error-box {
        background-color: #ff4c4c;
        color: #fff;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 20px;
    }
</style>
        }
    </style>
    
</head>
<body>

    <div class="form-card">
        <div class="form-header">
            <h2>Añadir Proyecto</h2>
            <p>Registra una nueva obra en el portafolio de ServiTecNet</p>
        </div>

        <!-- Muestra errores si falla la validación (ej: imagen muy pesada) -->
        @if ($errors->any())
            <div class="alert-error">
                <strong>¡Por favor corrige los siguientes errores!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario: Fíjate en el nuevo campo 'encargado' -->
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Título del Proyecto</label>
                <input type="text" name="title" required placeholder="Ej: Remodelación de Oficina Central">
            </div>

            <!-- boton de encargado -->
            <div class="form-group">
                <label>Ingeniero / Maestro Encargado</label>
                <input type="text" name="encargado" required placeholder="Ej: Juan Pérez">
            </div>
            
            <div class="form-group">
                <label>Descripción detallada</label>
                <textarea name="description" rows="4" required placeholder="Detalles del trabajo realizado, tiempo, etc..."></textarea>
            </div>
            <!--boton seleccionar imagen  -->
            <div class="form-group" style="border-left: 3px solid #fbc02d; padding-left: 10px;">
                <label>Fotografía del Proyecto</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <!--  MODELOS 3D -->
            <div class="form-group" style="border-left: 3px solid #4CAF50; padding-left: 10px;">
                <label>2. Modelo 3D Interactivo (Opcional: Formato .glb)</label>
                <input type="file" name="modelo_3d" accept=".glb,.gltf">
            </div>

            <!--  CHECKBOX DESTACADO -->
            <div class="form-group">
                <label style="cursor: pointer; color: #fbc02d; display: flex; align-items: center; gap: 10px; font-size: 0.95rem;">
                    <input type="checkbox" name="es_destacado" value="1" style="width: 20px; height: 20px; accent-color: #fbc02d;">
                    ⭐ Destacar este proyecto con modelo 3D en la página principal
                </label>
            </div>

            <!--boton guardar -->
            <div class="form-actions">
                <a href="{{ route('projects.index') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-submit">Guardar Proyecto</button>
            </div>
        </form>
    </div>

</body>
</html>