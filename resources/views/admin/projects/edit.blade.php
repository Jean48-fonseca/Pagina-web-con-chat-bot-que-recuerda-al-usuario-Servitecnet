<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto - ServiTecNet</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f7f3e8; 
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

        /* --- Estilo para la foto actual --- */
        .current-img-container {
            margin-bottom: 15px;
            background-color: #f7f3e8;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
        }

        .current-img {
            max-width: 100%;
            max-height: 250px;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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
            background-color: #eab474; 
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #d99f5e;
        }

        /* --- RESPONSIVIDAD EXCLUSIVA PARA EL FORMULARIO DE EDICIÓN --- */
        @media (max-width: 768px) {
            /* --- CÓDIGO NUEVO DEL MENÚ AQUÍ --- */
    header, nav, .navbar { 
        display: flex;
        flex-direction: column !important;
        align-items: center;
        padding: 15px 5px !important;
        height: auto !important;
    }
    
    header ul, nav ul, .nav-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px 15px;
        width: 100%;
        margin-top: 15px;
        padding: 0;
    }
    
    header ul li a, nav ul li a, .nav-links a {
        font-size: 0.8rem !important; 
        text-align: center;
        padding: 5px;
    }
    /* --------------------------------- */

    
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

    <div class="form-card">
        <div class="form-header">
            <h2>Editar Proyecto</h2>
            <p>Actualiza la información o la fotografía de esta obra.</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT') 
            
            <div class="form-group">
                <label>Título del Proyecto:</label>
                <input type="text" name="title" value="{{ $project->title }}" required>
            </div>

            <!-- Nuevo campo de Encargado -->
            <div class="form-group">
                <label>Ingeniero / Maestro Encargado:</label>
                <input type="text" name="encargado" value="{{ $project->encargado }}" required>
            </div>
            
            <div class="form-group">
                <label>Descripción:</label>
                <textarea name="description" rows="4" required>{{ $project->description }}</textarea>
            </div>
            
            <div class="form-group">
                <label>Fotografía Actual:</label>
                <div class="current-img-container">
                    <img src="{{ asset($project->image_path) }}" class="current-img" alt="Foto actual del proyecto">
                </div>
            </div>
            
            <div class="form-group">
                <label>Subir Nueva Fotografía (Opcional):</label>
                <input type="file" name="image" accept="image/*">
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
            <div class="form-actions">
                <a href="{{ route('projects.index') }}" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-submit">Actualizar Proyecto</button>
            </div>
        </form>
    </div>

</body>
</html>