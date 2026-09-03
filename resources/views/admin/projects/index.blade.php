<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            /* Un beige más tostado/caqui oscuro, no tan brillante */
            background-color: #b3a47d; 
            padding: 30px 20px;
        }

        .admin-dashboard {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* --- Encabezado --- */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .admin-title {
            font-size: 2rem;
            /* Un marrón espresso muy profundo, casi negro */
            color: #2b190d; 
            font-weight: 900;
        }

        .admin-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-add {
            /* Marrón arcilla más oscuro */
            background-color: #8a4822; 
            color: #ffffff;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 800;
            font-size: 0.9rem;
            box-shadow: 0 4px 6px rgba(138, 72, 34, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s;
        }

        .btn-add:hover {
            background-color: #6b3517; /* Aún más oscuro al pasar el ratón */
        }

        .search-box input {
            padding: 10px 15px;
            border-radius: 10px;
            /* Beige grisáceo oscuro para el borde */
            border: 1px solid #c2b4a1; 
            /* Fondo crema ligeramente tostado */
            background-color: #e6dac6; 
            color: #2b190d;
            font-size: 0.9rem;
            outline: none;
        }

        .search-box input:focus {
            border-color: #8a4822;
        }

        .btn-filter {
            /* Beige arena oscuro */
            background-color: #c4a68c; 
            border: none;
            padding: 10px 14px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            color: #2b190d;
        }

        .btn-filter:hover {
            background-color: #ab8e75;
        }

        /* --- Cuadrícula de Proyectos --- */
        .admin-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(480px, 1fr));
            gap: 25px;
        }

        .admin-card {
            /* En lugar de blanco puro, un tono tiza/hueso muy suave */
            background-color: #f7f4ec; 
            border-radius: 16px;
            padding: 18px;
            box-shadow: 0 10px 25px rgba(43, 25, 13, 0.15); /* Sombra marrón oscura */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-content {
            display: flex;
            gap: 18px;
            margin-bottom: 18px;
        }

        .card-img-container {
            width: 42%;
            height: 140px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
            border: 1px solid #e0d8c8;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .card-info {
            width: 58%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            font-size: 1rem;
            color: #2b190d; /* Marrón profundo */
            font-weight: 800;
            text-transform: uppercase;
            line-height: 1.3;
            margin-bottom: 6px;
        }

        .card-duration {
            font-size: 0.8rem;
            color: #5c4738; /* Marrón medio */
            margin-bottom: 6px;
        }

        .card-desc {
            font-size: 0.82rem;
            color: #4a3c31; /* Marrón texto general */
            line-height: 1.4;
            margin-bottom: 10px;
        }

        .card-pm {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 800;
            color: #382112;
            border-bottom: 3px solid #c4a68c;
            padding-bottom: 4px;
            width: fit-content;
        }

        /* --- Botones Inferiores --- */
        .card-buttons {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }

        .btn-edit {
            flex: 1;
            /* Marrón mostaza oscuro */
            background-color: #c99557; 
            color: #2b190d;
            padding: 10px 0;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 800;
            font-size: 0.85rem;
            text-align: center;
            display: block;
            transition: 0.3s;
        }

        .btn-edit:hover {
            background-color: #b07e44;
        }

        .form-delete {
            flex: 1;
            display: flex;
        }

        .btn-delete {
            width: 100%;
            /* Rojo arcilla/ladrillo oscuro */
            background-color: #ab4631; 
            color: #ffffff;
            border: none;
            padding: 10px 0;
            border-radius: 8px;
            font-weight: 800;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-delete:hover {
            background-color: #8a3422;
        }

        /* --- RESPONSIVIDAD (CELULARES Y TABLETS) --- */
       @media (max-width: 768px) {
            
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

    <meta charset="UTF-8">
    <title>Panel de Administración - Proyectos</title>
    <!-- Aquí asumo que tienes conectada tu hoja de estilos CSS -->
</head>
<body>
    <div class="admin-dashboard">
        
        <!-- Encabezado del Panel -->
        <div class="admin-header-left">
            <nav> 
                    <div class="logo-container">
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo ServiTecNet" class="logo-img">
                        </a>
                    </div>
                </nav>

            <h1 class="admin-title">Gestión de Proyectos</h1>
            
            <div class="admin-actions">
                <!-- ¡Aquí está tu botón de Añadir Nuevo Proyecto! -->
                <a href="{{ route('projects.create') }}" class="btn-add">
                    👷 Añadir Nuevo Proyecto
                </a>
                <a href="{{ route('leads.index') }}" style="background-color: #2b190d; color: #ffffff; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold; margin-left: 15px; display: inline-flex; align-items: center;">
    📥 Ver Cotizaciones IA
</a>
                <div class="search-box">
                    <input type="text" placeholder="🔍 Buscar">
                </div>
                <button class="btn-filter">🎛️</button>
            </div>
        </div>

        <!-- Cuadrícula de Tarjetas -->
        <div class="admin-grid">
            
            <!-- EL BUCLE: Esta línea es la que crea la variable $project -->
            @foreach($projects as $project)
            <div class="admin-card">
                
                <!-- Parte superior (Foto + Info) -->
                <div class="card-content">
                    <div class="card-img-container">
                        <img src="{{ asset($project->image_path) }}" alt="{{ $project->title }}" class="card-img">
                    </div>
                    
                    <div class="card-info">
                        <h3 class="card-title">{{ $project->title }}</h3>
                        <p class="card-duration"><strong>Duración Estimada:</strong> 5 MESES</p>
                        <p class="card-desc">{{ Str::limit($project->description, 80) }}</p>
                        
                        <div class="card-pm">
                            <span class="pm-avatar">👷</span>
                            <span class="pm-name">{{ $project->encargado }}</span>
                        </div>
                    </div>
                </div>

                <!-- Parte inferior (Botones de acción) -->
                <div class="card-buttons">
                    <!-- Botón Editar -->
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn-edit">EDITAR</a>
                    
                    <!-- Botón Eliminar -->
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" style="width: 100%;" onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto de forma permanente?')">ELIMINAR</button>
                    </form>
                </div>
                
            </div>
            @endforeach <!-- FIN DEL BUCLE -->
            
        </div>
    </div>
</body>
</html>