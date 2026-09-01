<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiTecNet - Inicio</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
        /* --- Estilos del Chatbot Flotante --- */
        .chat-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #fbc02d; /* Amarillo que combina con tu intranet */
            color: #222;
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
            z-index: 9999;
            transition: transform 0.3s;
        }
        .chat-btn:hover { transform: scale(1.1); }
        
        .chat-window {
            position: fixed;
            bottom: 110px;
            right: 30px;
            width: 350px;
            height: 480px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            z-index: 9999;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }
        
        .chat-header {
            background: #222;
            color: #fbc02d;
            padding: 15px;
            font-weight: bold;
            font-size: 1.1rem;
            text-align: center;
        }
        
        .chat-body {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            background: #f4f7f6;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .message {
            padding: 10px 14px;
            border-radius: 8px;
            max-width: 85%;
            font-size: 0.95rem;
            line-height: 1.4;
        }
        
        .bot-message {
            background: #e0e0e0;
            align-self: flex-start;
            color: #222;
            border-bottom-left-radius: 0;
        }
        
        .user-message {
            background: #fbc02d;
            color: #222;
            align-self: flex-end;
            border-bottom-right-radius: 0;
            font-weight: bold;
        }
        
        .chat-input-area {
            display: flex;
            padding: 15px;
            border-top: 1px solid #ddd;
            background: white;
        }
        
        .chat-input-area input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
            outline: none;
        }
        
        .chat-input-area button {
            background: #222;
            color: #fbc02d;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
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
            /* --- Ajustes específicos para la portada pública --- */
    
    /* Pasa el contenedor dividido a una sola columna vertical */
    .hero, .seccion-inicio {
        display: flex;
        flex-direction: column;
        padding: 20px 15px;
    }

    /* Achica el texto gigante (Cambia 'h1' si usaste otra clase) */
    h1 { 
        font-size: 2.2rem !important;
        text-align: center;
        line-height: 1.2;
    }

    /* Evita que los contenedores se desborden por los lados */
    .container, .seccion {
        width: 100% !important;
        max-width: 100%;
        padding: 0 15px;
        box-sizing: border-box;
    }
        }
       
    .tarjeta-3d {
        position: relative;
        width: 100%;
        height: 300px; /* Esto obliga a que todas las tarjetas midan lo mismo */
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
        object-fit: cover; /* Esto evita que la imagen se estire o se deforme */
        z-index: 2; /* Pone la imagen en la capa de arriba */
        transition: opacity 0.5s ease; /* Hace que desaparezca suavemente */
    }

    .modelo-fondo {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1; /* Pone el 3D en la capa de abajo, esperando */
    }

    /* La magia: Cuando pasas el mouse, la imagen se vuelve transparente */
    .tarjeta-3d:hover .img-frontal {
        opacity: 0;
        pointer-events: none;
    }
    .btn-whatsapp-flotante {
    position: fixed;
    bottom: 30px;
    left: 30px; /* Esquina inferior izquierda */
    background-color: #25d366; /* Verde oficial de WhatsApp */
    color: white;
    width: 65px;
    height: 65px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    z-index: 9999;
    transition: transform 0.3s;
}
.btn-whatsapp-flotante:hover {
    transform: scale(1.1);
    color: white;
}

    </style>
</head>
<body>

    <nav class="main-nav">
        <!-- Logo de la empresa -->
        <div class="logo-container">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo ServiTecNet" style="max-height: 75px; width: auto; transition: 0.3s;">
            </a>
        </div>
        
        <ul class="nav-menu">
            <li><a href="/">INICIO</a></li>
          <!--Estos usan el ID para bajar automaticamente a la sección -->
            <li><a href="#construccion">CONSTRUCCIÓN</a></li>
            <li><a href="#proyectos">PROYECTOS</a></li>
            <li><a href="#servicios">SERVICIOS</a></li>
            <li><a href="https://wa.me/51922657185" target="_blank">CONTACTO</a></li>
            <!--Logica de Autenticación -->
           @guest
            <li>
                <a href="{{ route('admin.login') }}" style="color: #fbc02d; font-weight: 900; letter-spacing: 1px;">
                    Inicia Sesión o registrate
                </a>
            </li>
            @endguest
            @auth
            <!-- Solo lo ven los usuarios logueados -->
        <!-- Diseño Profesional de Usuario Logueado -->
        <li style="display: flex; align-items: center;">
            <div style="display: flex; align-items: center; background: rgba(255, 255, 255, 0.08); padding: 6px 16px; border-radius: 50px; border: 1px solid rgba(251, 192, 45, 0.3); backdrop-filter: blur(4px);">
                
                <!-- Icono de Usuario -->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fbc02d" viewBox="0 0 16 16" style="margin-right: 8px;">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
                
                <!-- Nombre (Extrae inteligentemente solo el primer nombre) -->
                <a href="{{ route('projects.index')}}" style="color: #ffffff; font-weight: 600; font-size: 0.9rem; letter-spacing: 0.5px; text-transform: capitalize; margin-right: 12px;">
                    {{ explode(' ', Auth::user()->name)[0] }}
                   </a>
                
                <!-- Línea separadora sutil -->
                <div style="width: 1px; height: 18px; background: rgba(255, 255, 255, 0.2); margin-right: 12px;"></div>

                <!-- Botón de Salir Elegante -->
                <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0; display: flex; align-items: center;">
                    @csrf
                    <button type="submit" title="Cerrar sesión" style="background: transparent; border: none; color: #fbc02d; cursor: pointer; padding: 0; display: flex; align-items: center; transition: 0.3s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#fbc02d'">
                        <!-- Icono de Salir (Puerta) -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                          <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </li>
    @endauth
        </ul>
    </nav>

    <header class="hero-slider">
        <div class="hero-content">
            <h1>CONSTRUCCIÓN E INGENIERÍA</h1>
            <h2>DISEÑO ARQUITECTÓNICO - OBRAS GENERALES<br>PROYECTOS LLAVE EN MANO</h2>
        </div>

        <div class="slider-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    
    </header>
<!-- Sección Dinámica de Proyectos -->
    <section  id="proyectos" class="projects-section">
        <h2>NUESTROS PROYECTOS RECIENTES</h2>
        
        <div class="projects-grid">
            <!-- Iniciamos el bucle: Por cada proyecto en la BD, genera este HTML -->
            @foreach($projects as $project)
                <div class="project-card">
                    @if($project->es_destacado == 1 && $project->modelo_3d_ruta)
        <!-- Visor 3D Interactivo con efecto Hover-->
        <div class="tarjeta-3d">
            
            <!-- 1. La Imagen normal (Se oculta al pasar el mouse) -->
            <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="img-frontal">
            
            <!-- Etiqueta indicadora (para que el cliente sepa que hay algo más) -->
            <span style="position: absolute; top: 10px; right: 10px; background: #fbc02d; color: #000; padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 0.75rem; z-index: 3; box-shadow: 0 2px 5px rgba(0,0,0,0.5); pointer-events: none;">
                👀 Pasa el mouse
            </span>

            <!-- 2. El Visor 3D (Siempre está ahí, pero oculto atrás) -->
            <model-viewer 
                src="{{ asset('storage/' . $project->modelo_3d_ruta) }}" 
                alt="Modelo 3D" 
                auto-rotate 
                camera-controls 
                class="modelo-fondo">
            </model-viewer>
        </div>
    @else
        <!-- Imagen Normal (para proyectos comunes) -->
        <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: 8px 8px 0 0;">
    @endif

    <!-- Aquí debajo va el título y la descripción del proyecto... -->
    <h3>{{ $project->title }}</h3>
    <p>{{ $project->description }}</p>
                    
                </div>
            @endforeach
        </div>
    </section>

    <!-- --- SECCIÓN DE CONTACTO --- -->
<div class="contacto-section" style="text-align: center; padding: 50px 20px; background-color: #f7f4ec;">
    <h2 style="color: #2b190d; font-weight: 900; font-size: 2.5rem; text-transform: uppercase;">Información Directa</h2>
    <p style="color: #4a3c31; margin-bottom: 30px;">Comunícate con nuestros ingenieros y maestros de obra para una asesoría personalizada.</p>
    
    <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap; color: #2b190d;">
       
        <!-- Info Correo -->
        <div>
            <h4 style="color: #c99557;">Correo Electrónico</h4>
            <p>experto.sistemasti@gmail.com</p>
        </div>
        <!-- Info Ubicación -->
        <div>
            <h4 style="color: #c99557;">Ubicación</h4>
            <p>Villa María del Triunfo, Lima, Perú</p>
        </div>
    </div>
</div>
    <!-- Burbuja Flotante -->
    <div class="chat-btn" onclick="toggleChat()">
        💬
    </div>
    <!-- --- SECCIÓN DE SERVICIOS --- -->
<section class="services-section" id="servicios">
    <div class="container">
        <h2 class="section-title">Nuestras <span>Especialidades</span></h2>
        <p class="section-subtitle">Soluciones integrales en construcción e ingeniería para tu proyecto.</p>

        <div class="services-grid">
            <!-- Tarjeta 1: Vaciado -->
            <div class="service-card">
                <div class="service-icon">🏗️</div>
                <h3>Vaciado de Pisos</h3>
                <p>Nivelación y vaciado de concreto de alta resistencia para bases sólidas y duraderas en cualquier tipo de obra.</p>
            </div>
            
            <!-- Tarjeta 2: Drywall -->
            <div class="service-card">
                <div class="service-icon">🏢</div>
                <h3>Instalación de Drywall</h3>
                <p>Construcción de divisiones, cielorrasos y estructuras ligeras con acabados perfectos y tiempos de ejecución rápidos.</p>
            </div>

            <!-- Tarjeta 3: Ladrillos -->
            <div class="service-card">
                <div class="service-icon">🧱</div>
                <h3>Asentamiento de Ladrillos</h3>
                <p>Levantamiento de muros estructurales y perimetrales con precisión, aplomado exacto y máxima seguridad.</p>
            </div>

            <!-- Tarjeta 4: Tarrajeo -->
            <div class="service-card">
                <div class="service-icon">✨</div>
                <h3>Tarrajeo y Acabados</h3>
                <p>Revestimiento profesional de muros y techos listos para pintura, garantizando superficies 100% impecables y lisas.</p>
            </div>
        </div>
    </div>
</section>
    <!-- Ventana del Chat (Oculta al inicio) -->
    <div class="chat-window" id="chatWindow" style="display: none;">
        <div class="chat-header">
            Ingeniero Virtual - ServiTecNet
            <span onclick="toggleChat()" style="cursor:pointer; float:right; color: white;">✖</span>
        </div>
        
        <div class="chat-body" id="chatBody">
            <div class="message bot-message">
                ¡Hola! Soy el asistente virtual de ServiTecNet. ¿Buscas información sobre nuestros proyectos, obras generales o necesitas contactarnos?
            </div>
        </div>
        
        <div class="chat-input-area">
            <!-- Agregamos 'onkeypress' para poder enviar con la tecla Enter -->
            <input type="text" id="chatInput" placeholder="Escribe tu consulta..." onkeypress="if(event.key === 'Enter') enviarMensaje()">
            <button onclick="enviarMensaje()">Enviar</button>
        </div>
    </div>

    <!-- Lógica de conexión con tu Backend -->
    <script>
       // 1. AQUÍ CREAMOS LA MEMORIA DEL CHAT (El cuaderno de notas vacío)
        let historialChat = [];

        function toggleChat() {
            var chat = document.getElementById("chatWindow");
            chat.style.display = (chat.style.display === "none" || chat.style.display === "") ? "flex" : "none";
        }

        // Función para enviar el mensaje a tu backend
        window.enviarMensaje = async function() {
            const input = document.getElementById("chatInput");
            const messageText = input.value.trim();
            const chatBody = document.getElementById("chatBody");

            // Si el input está vacío, no hace nada
            if (messageText === "") return;

            // 1. Mostrar el mensaje del usuario en la pantalla
            chatBody.innerHTML += `<div class="message user-message">${messageText}</div>`;
            input.value = ""; // Limpiar la caja de texto
            // Bajar el scroll al último mensaje
            chatBody.scrollTop = chatBody.scrollHeight;
            // 2. GUARDAMOS LO QUE DIJO EL USUARIO EN LA MEMORIA
            historialChat.push({ role: "user", content: messageText });
           
            // Mostrar un "Escribiendo..." temporal
            const typingId = "typing-" + Date.now();
            chatBody.innerHTML += `<div id="${typingId}" class="message bot-message" style="font-style: italic; color: #888;">El ingeniero está analizando... ⏳</div>`;
            chatBody.scrollTop = chatBody.scrollHeight;

            try {
                // 3. Enviar el texto a tu backend de Laravel (DeepSeek)
                const response = await fetch("{{ route('chat.enviar') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}" // Seguridad obligatoria de Laravel
                    },
                    body: JSON.stringify({ historial: historialChat }) 
                });

                const data = await response.json();

                //  Quitar el "Escribiendo..."
                document.getElementById(typingId).remove();
                
                let respuestaBot = data.respuesta;
                // 4. GUARDAMOS LO QUE RESPONDIÓ LA IA EN LA MEMORIA PARA QUE LO RECUERDE DESPUÉS
                historialChat.push({ role: "assistant", content: respuestaBot });
                // ==========================================
                // MAGIA: DETECTAMOS SI LA IA TERMINÓ (ETIQUETA [WHATSAPP])
                // ==========================================
                if (respuestaBot.includes("[WHATSAPP]")) {
                    // Limpiamos la etiqueta para que no se vea el texto "[WHATSAPP]"
                    let textoResumen = respuestaBot.replace("[WHATSAPP]", "").trim();
                    
                    // Mostramos el resumen limpio
                    chatBody.innerHTML += `<div class="message bot-message">${textoResumen}</div>`;
                    
                    // Creamos el enlace para WhatsApp
                    let mensajeParaWP = encodeURIComponent("Hola ServiTecNet, vengo del asistente virtual. Solicito más información sobre: " + textoResumen);
                    
                    // Agregamos el BOTÓN VERDE dentro del chat
                    chatBody.innerHTML += `
                        <div style="text-align: center; margin-top: 15px; margin-bottom: 10px;">
                            <a href="https://wa.me/51922657185?text=${mensajeParaWP}" target="_blank" style="background-color: #25d366; color: white; padding: 10px 15px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block; box-shadow: 0 4px 6px rgba(0,0,0,0.2); font-size: 0.9rem;">
                                📲 Enviar al WhatsApp
                            </a>
                        </div>`;
                } else {
                    // Si todavía está haciendo preguntas, muestra el mensaje normal
                    chatBody.innerHTML += `<div class="message bot-message">${respuestaBot}</div>`;
                }
                
                // Bajar el scroll para ver la nueva respuesta
                chatBody.scrollTop = chatBody.scrollHeight;

            } catch (error) {
                // En caso de error de conexión
                document.getElementById(typingId).remove();
                chatBody.innerHTML += `<div class="message bot-message" style="color: #ab4631; font-weight: bold;">Hubo un error de conexión.</div>`;
            }
        }

        // Hacer que también se envíe al presionar la tecla "Enter"
        document.getElementById("chatInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                enviarMensaje();
            }
        });
    </script>
    <div class="cursor-dot"></div>
<div class="cursor-outline"></div>
<!--Libreria para el visor 3D-->
 <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script>
<!-- BUBBULA DE WHATSAPP FLOTANTE -->
<a href="https://wa.me/51922657185" target="_blank" class="btn-whatsapp-flotante" title="Escríbenos al WhatsApp">
    <!-- Ícono SVG de WhatsApp -->
    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" viewBox="0 0 16 16">
        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c-.003 1.398.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.005-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
    </svg>
</a>
</body>
</html>