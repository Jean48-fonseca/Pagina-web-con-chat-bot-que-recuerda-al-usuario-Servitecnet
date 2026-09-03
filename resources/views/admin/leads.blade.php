<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotizaciones - Admin ServiTecNet</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Montserrat', sans-serif; }
        body { background-color: #111111; padding: 30px 20px; color: #ffffff; }
        .admin-container { max-width: 1200px; margin: 0 auto; background-color: #1a1a1a; padding: 30px; border-radius: 8px; border: 1px solid #333; }
        
        .admin-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 30px; }
        .admin-header h1 { color: #fbc02d; text-transform: uppercase; font-weight: 900; }
        .btn-volver { background-color: #333; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-weight: bold; }
        .btn-volver:hover { background-color: #555; }

        .tabla-leads { width: 100%; border-collapse: collapse; }
        .tabla-leads th { background-color: #222; color: #888; text-align: left; padding: 15px; border-bottom: 2px solid #fbc02d; text-transform: uppercase; font-size: 0.85rem; }
        .tabla-leads td { padding: 15px; border-bottom: 1px solid #333; vertical-align: middle; line-height: 1.5; color: #ddd; }
        .tabla-leads tr:hover { background-color: #252525; }

        .badge-pendiente { background-color: #ab4631; color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem; font-weight: bold; }
        .fecha { color: #888; font-size: 0.85rem; }
     /* --- RESPONSIVIDAD (CELULARES Y TABLETS) --- */
        @media (max-width: 768px) {
    /* Ajuste de Botones Flotantes para que no estorben */
    .chat-btn, .btn-whatsapp-flotante {
        width: 55px;
        height: 55px;
        bottom: 15px;
        font-size: 24px;
    }
    .chat-btn { right: 15px; }
    .btn-whatsapp-flotante { left: 15px; }

    /* Ajuste de la Ventana del Chatbot (Fluida) */
    .chat-window {
        width: calc(100% - 30px);
        right: 15px;
        bottom: 80px;
        height: 420px;
    }

    /* Título y Logo */
    .header-left {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    /* Botones de Administración */
    .admin-actions {
        width: 100%;
        flex-direction: column;
        align-items: stretch;
    }
    .search-box input { width: 100%; }

    /* Tarjetas de Administración */
    .admin-grid { grid-template-columns: 1fr; }
    .card-content { flex-direction: column; }
    .card-img-container {
        width: 100%;
        height: 200px; 
    }
    .card-info { width: 100%; }
    .card-buttons { flex-wrap: wrap; }
    
    /* Portada Pública y Textos */
    .hero, .seccion-inicio {
        display: flex;
        flex-direction: column;
        padding: 20px 15px;
        text-align: center;
    }
    h1 { 
        font-size: 2rem !important;
        line-height: 1.2;
    }
    .container, .seccion {
        width: 100% !important;
        max-width: 100%;
        padding: 0 15px;
        box-sizing: border-box;
        overflow-x: hidden; /* Evita el scroll horizontal fantasma */
    }
}
    
    </style>
</head>
<body>

    <div class="admin-container">
        <div class="admin-header">
            <h1>📥 Cotizaciones de la IA</h1>
            <a href="{{ route('projects.index') }}" class="btn-volver">Volver a Proyectos</a>
        </div>

        <table class="tabla-leads">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Resumen del Proyecto (Generado por IA)</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                <tr>
                    <td style="color: #fbc02d; font-weight: bold;">#{{ $lead->id }}</td>
                    <td class="fecha">{{ $lead->created_at->format('d/m/Y - h:i A') }}</td>
                    <td>{{ $lead->resumen_proyecto }}</td>
                    <td>
                        <span class="badge-pendiente">{{ $lead->estado }}</span>
                    </td>
                </tr>
                @endforeach
                
                @if($leads->isEmpty())
                <tr>
                    <td colspan="4" style="text-align: center; padding: 30px; color: #888;">
                        Aún no hay cotizaciones. ¡El bot está esperando clientes!
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</body>
</html>