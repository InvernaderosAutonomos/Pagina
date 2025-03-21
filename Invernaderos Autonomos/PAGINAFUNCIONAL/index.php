<?php
session_start(); // Asegúrate de que la sesión esté iniciada

// Verificar si hay datos en la sesión
if (isset($_SESSION['nombre_usuario'], $_SESSION['apellidos'], $_SESSION['correo'], $_SESSION['telefono'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $apellidos = $_SESSION['apellidos'];
    $correo = $_SESSION['correo'];
    $telefono = $_SESSION['telefono'];
} else {
    // Si no hay datos en la sesión, asignar valores predeterminados
    $nombre_usuario = "Cargando...";
    $apellidos = "Cargando...";
    $correo = "Cargando...";
    $telefono = "Cargando...";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVERNADEROS AUTONOMOS - Consola de Control</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="icon.png">
    <!-- Este codigo no sé donde ponerlo de los scripts que tienes, puedes modificarlo despuecito? UnU -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const params = new URLSearchParams(window.location.search);
            if (params.get("registro") === "exitoso") {
                mostrarNotificacion("Usuario registrado correctamente", "green");
            } else if (params.get("registro") === "fallido") {
                mostrarNotificacion("Error: El correo ya está registrado", "red");
            }
        });
    
        function mostrarNotificacion(mensaje, color) {
            const notificacion = document.createElement("div");
            notificacion.textContent = mensaje;
            notificacion.style.position = "fixed";
            notificacion.style.top = "20px";
            notificacion.style.left = "50%";
            notificacion.style.transform = "translateX(-50%)";
            notificacion.style.backgroundColor = color;
            notificacion.style.color = "white";
            notificacion.style.padding = "10px 20px";
            notificacion.style.borderRadius = "5px";
            notificacion.style.boxShadow = "0 4px 6px rgba(0, 0, 0, 0.1)";
            notificacion.style.zIndex = "1000";
            document.body.appendChild(notificacion);
    
            setTimeout(() => {
                notificacion.remove();
            }, 3000);
        }







 // Esperar que la página se cargue completamente
 document.addEventListener("DOMContentLoaded", function() {
            // Establecer los valores de los datos del usuario en los elementos correspondientes
            document.getElementById("nombre_usuario").textContent = "Nombre: <?php echo $nombre_usuario; ?>";
            document.getElementById("apellidos").textContent = "Apellidos: <?php echo $apellidos; ?>";
            document.getElementById("correo").textContent = "Correo: <?php echo $correo; ?>";
            document.getElementById("telefono").textContent = "Teléfono: <?php echo $telefono; ?>";
        });







    </script>


</head>
<body>
    <script>
        // Función para detectar la resolución y aplicar una clase al body
        function detectarResolucion() {
            const ancho = window.innerWidth;
            const alto = window.innerHeight;

            // Limpiar clases anteriores
            document.body.classList.remove('resolucion-baja', 'resolucion-media', 'resolucion-alta');

            // Aplicar clase según la resolución
            if (ancho <= 480) {
                document.body.classList.add('resolucion-baja'); // Resolución baja (móviles pequeños)
            } else if (ancho <= 768) {
                document.body.classList.add('resolucion-media'); // Resolución media (tablets o móviles grandes)
            } else {
                document.body.classList.add('resolucion-alta'); // Resolución alta (computadoras)
            }
        }

        // Ejecutar la función al cargar la página
        window.addEventListener('load', detectarResolucion);

        // Ejecutar la función al cambiar el tamaño de la ventana
        window.addEventListener('resize', detectarResolucion);
    </script>

    <!-- Encabezado -->
<header data-color="#2c3e50" data-color-texto="#ffffff">
    <div class="logo">
        <img src="2d7e10807de3e102a581edff74a4aaba.avif" alt="Icono de INVERNADEROS AUTONOMOS" class="icono">
        <h1>INVERNADEROS AUTONOMOS</h1>
    </div>
</header>

  <!-- Cuerpo - Interfaz de consola -->
  
<main class="consola">
    <!-- Panel izquierdo (secundario) -->
    <div  class="panel-izquierdo panel" id="panel-izquierdo">
        <div class="estado-conexion">
            <h3>Estado de Conexión</h3>
            <p>NO Conectado <span id="indicador-conexion" class="indicador-conexion"></span><br>  <br> Última conexión: Desconocida</p>
        </div>
    </div>

    <!-- Panel de conexión (oculto inicialmente) -->
<div class="menu-configuracion" id="menu-panel-izquierdo">
    <center><h2>Opciones de Conexión</h2></center>
    <div class="contenido-panel">
        <!-- Contenido estático o dinámico -->
        <div class="contenido-panel-izquierdo">
            <!-- Casilla 1 -->
            <div class="casilla">
                <h4>NOMBRE DEL DISPOSITIVO:</h4>
                <p></p>
            </div>
            <!-- Casilla 2 -->
            <div class="casilla">
                <h4>ID DEL DISPOSITIVO:</h4>
                <p>Desconocido</p>
            </div>
        </div>
        <button class="btn-volver-configuracion">
            <span class="btn-icon">⬅️</span>
            <span class="btn-text">Volver</span>
        </button>
    </div>
</div>
    

   <!-- Centro (principal) -->
   <div class="centro panel">
    <div class="bienvenida">
        <h2>CONSOLA DE CONTROL</h2>
        <p>Gestiona y controla tu dispositivo Arduino de manera remota.</p>

<script>
//***********************************************************CONEXION DE ARDUINO********************************************************************************************************* */


async function obtenerLecturas() {
    try {
        const respuesta = await fetch("http://192.168.137.195/lecturas");
        const datos = await respuesta.json();
        document.getElementById("panel-cuadrado-Humedad").innerText = datos.humedadSuelo;
        document.getElementById("panel-cuadrado-Temperatura");
        document.getElementById("panel-cuadrado-Humedad-Aire").innerText = datos.humedadAire;
        document.getElementById("panel-cuadrado-Presencia").innerText = datos.presencia;
    } catch (error) {
        console.error("Error al obtener las lecturas:", error);
    }
}

// Actualizar lecturas cada 3 segundos
setInterval(obtenerLecturas, 3000);

//***********************************************************FIN CONEXION DE ARDUINO********************************************************************************************************* */
</script>
        
    </div>

    <!-- Contenedor para los 4 paneles cuadrados -->
    <div class="paneles-cuadrados">
        <!-- Panel 1: Humedad del suelo -->
        <div class="panel-cuadrado-Humedad">
            <h3>Humedad del suelo</h3>
            <p class="valor" id="humedad">CARGANDO...</p>
        </div>

        <!-- Panel 2: Temperatura -->
        <div class="panel-cuadrado-Temperatura">
            <h3>Temperatura</h3>
            <p class="valor" id="temperatura">CARGANDO...</p>
        </div>

        <!-- Panel 3: Humedad del aire -->
        <div class="panel-cuadrado-Humedad-Aire">
            <h3>Humedad del aire</h3>
            <p class="valor" id="humedadAire">CARGANDO...</p>
        </div>

        <!-- Contenedor para "Presencia" y el nuevo botón -->
        <div class="panel-cuadrado-contenedor">
            <!-- Cuadro de Presencia -->
            <div class="panel-cuadrado-Presencia">
                <h3>Presencia</h3>
                <p class="valor" id="presencia">CARGANDO...</p>
            </div>

            <!-- Nuevo botón -->
            <button class="panel-cuadrado boton-adicional" >
                <span>Personalizado (NO DISPONIBLE)</span>
            </button>
        </div>
    </div>

    <!-- Botón de configuración -->
    <div class="botones-consola">
        <button class="btn-consola" id="btn-configuracion" data-color-botones="#0fa037" data-color-texto="#ffffff">
            <span>Configuración</span>
        </button>
    </div>
</div>


      <!-- Panel derecho (secundario) -->
      <div class="panel-derecho panel" id="panel-derecho">
        <div class="notificaciones">
            <h3>actualizaciones</h3>
            <ul>
                <li>Historial de actualizaciones</li>
                <li>----------------------------</li>
                <li>Ver. 0.6.0 Conexion fix</li>
            </ul>
        </div>
    </div>
</main>

<!-- Panel de notificaciones (oculto inicialmente) -->
<div class="menu-configuracion" id="menu-panel-derecho">
    <center><h2>Historial de Actualizaciones</h2></center>
    <div class="contenido-panel">

        <div class="panel-actualizacion">
            <div class="fecha">19 de Marzo de 2025</div>
            <div class="subtitulo">Versión 0.6.0 - Interfaz de usuario</div>
            <div class="texto">
              Se añadio la interfaz de usuario en "Configuracion > Cuenta" Permitiendo visualizar los datos de la cuenta y modificar la imagen de perfil
            </div>
        </div>

        <!-- Panel de actualización 1 -->
        <div class="panel-actualizacion">
            <div class="fecha">1 de Marzo de 2025</div>
            <div class="subtitulo">Versión 0.5.5 - Fix de conexión</div>
            <div class="texto">
                Se corrigió un problema que impedía la conexión estable con el servidor para las cuentas. Ahora la conexión es más rápida y confiable.
            </div>
        </div>

        <!-- Panel de actualización 2 -->
         
        <div class="panel-actualizacion">
            <div class="fecha">20 de Febrero de 2025</div>
            <div class="subtitulo">Versión 0.5.0 - Mejoras en la interfaz v4</div>
            <div class="texto">
               Se mejoro la interfaz general de la pagina, ademas de la implementacion de los "TEMAS"
            </div>
        </div>

        <!-- Panel de actualización 3 -->
        <div class="panel-actualizacion">
            <div class="fecha">14 de Febrero de 2025</div>
            <div class="subtitulo">Versión 0.4.5 - Nuevas funcionalidades</div>
            <div class="texto">
                Se agregaron nuevas funcionalidades, como la gestión de dispositivos y el historial de actualizaciones
            </div>
        </div>

        <div class="panel-actualizacion">
            <div class="fecha">12 de Febrero de 2025</div>
            <div class="subtitulo">Versión 0.4.0 - Support android</div>
            <div class="texto">
                Se agrego la compatibilidad de interfaz para pantallas moviles (desactivado hasta la ver 0.9.5)
            </div>
        </div>

        <div class="panel-actualizacion">
            <div class="fecha">5 de Enero de 2025</div>
            <div class="subtitulo">Versión 0.3.5 - Mejoras de interfaz v3</div>
            <div class="texto">
                Se mejoró la interfaz de usuario, agregando nuevos temas y animaciones. Además, se optimizó el rendimiento general.
            </div>
        </div>

        <div class="panel-actualizacion">
            <div class="fecha">29 de Diciembre de 2024</div>
            <div class="subtitulo">Versión 0.3.0 - Configuración</div>
            <div class="texto">
                Se agregaron las "OPCIONES DE CONFIGURACION" esto con el fin de tener un sitio para accerder comodamente a las opciones del sitio
            </div>
        </div>

        <div class="panel-actualizacion">
            <div class="fecha">23 de Diciembre de 2024</div>
            <div class="subtitulo">Versión 0.2.5 - Nueva interfaz v2</div>
            <div class="texto">
                Es desechada la antigua interfaz copuesta por los 4 botones centrales y es puesta la nueva interfaz la cual es mas amigable y agradable a la vista
            </div>
        </div>

        <div class="panel-actualizacion">
            <div class="fecha">18 de Noviembre de 2024</div>
            <div class="subtitulo">Versión 0.2.0 - Color uptade</div>
            <div class="texto">
                Se elijieron mas colores a corde a estos botones para testear su visualizacion y poder cuestionarlo
            </div>
        </div>

        <div class="panel-actualizacion">
            <div class="fecha">15 de Noviembre de 2024</div>
            <div class="subtitulo">Versión 0.1.5 - Nueva interfaz</div>
            <div class="texto">
                Se añadio la Nueva interfaz la cual se compone de  un "HEADER" y "FOOTER" con un centro de 4 botones para hacer la interaccion lo mas rapido posible
            </div>
        </div>

        <div class="panel-actualizacion">
            <div class="fecha">21 de Octubre de 2024</div>
            <div class="subtitulo">Versión 0.1.0 - Porpuesta</div>
            <div class="texto">
          Se añaden las propuestas para las Opciones de funcion dentro de la pagina   "TEMPERATURA", "HUMEDAD A SUELO" y "HUMEDAD A AIRE"
  </div>
        </div>

        <div class="panel-actualizacion">
            <div class="fecha">20 de Octubre de 2024</div>
            <div class="subtitulo">Versión 0.0.5 - Creacion</div>
            <div class="texto">
                Se crea la primera propuesta para la pagina basada en un simple texto y boton de conexion
            </div>
        </div>

        <!-- Botón de "Volver" -->
        <button class="btn-volver-configuracion">
            <span class="btn-icon">⬅️</span>
            <span class="btn-text">Volver</span>
        </button>
    </div>
</div>


    <!-- Nuevo contenido (oculto inicialmente) -->
    <div class="nuevo-contenido" id="nuevo-contenido">
        <br>      <br>      <br>      <br> <br>     
        <h2>Configuración</h2>
        <div class="configuracion-opciones">
            <!-- Botones de configuración -->
            <button class="btn-configuracion" id="btn-tema" data-menu="menu-tema">
                <span class="btn-icon">🎨</span>
                <span class="btn-text">Tema</span>
            </button>
            <button class="btn-configuracion" id="btn-sonido" data-menu="menu-sonido">
                <span class="btn-icon">👤</span>
                <span class="btn-text">Cuenta</span>
            </button>
            <button class="btn-configuracion" id="btn-politicas" data-menu="menu-politicas">
                <span class="btn-icon">📜</span>
                <span class="btn-text">Políticas de uso/privacidad</span>
            </button>
            <button class="btn-configuracion" id="btn-dispositivos" data-menu="menu-dispositivos">
                <span class="btn-icon">📱</span>
                <span class="btn-text">Administrar dispositivos</span>
            </button>
            <button class="btn-configuracion" id="btn-animaciones" data-menu="menu-animaciones">
                <span class="btn-icon">🎬</span>
                <span class="btn-text">Animaciones</span>
            </button>           
            <button class="btn-configuracion" id="btn-reestablecer" data-menu="menu-reestablecer">
                <span class="btn-icon">🔈</span>
                <span class="btn-text">Sonido</span>
            </button>
            <button class="btn-configuracion" id="btn-volver">
                <span class="btn-icon">⬅️</span>
                <span class="btn-text">Volver</span>
            </button>
        </div>
    </div>

    <!-- Menús de configuración -->
   <!-- Menús de configuración -->
<div class="menu-configuracion" id="menu-tema">
    <center><h2>Opciones de Tema</h2></center>
    
    <!-- Contenedor de opciones de tema con scroll -->
    <div class="temas-container">
       <!-- Tema Original -->
<div class="tema-opcion" data-color="#f5f5f5" data-color-oscuro="#ffffff" data-color-texto="#333" data-color-botones="#2c3e50" style="background-color: #f5f5f5;">
   <span class="tema-texto">Tema Original</span>
    <label class="tema-interruptor">
        <input type="checkbox" checked>
        <span class="tema-slider"></span>
    </label>
</div>
        
           <!-- Tema Oscuro -->
<div class="tema-opcion" data-color="#2c2f33" data-color-oscuro="#23272a" data-color-texto="#ffffff" data-color-botones="#7289da" style="background-color: 	#2c2f33;">
    <span class="tema-texto">Tema Oscuro </span>
    <label class="tema-interruptor">
        <input type="checkbox">
        <span class="tema-slider"></span>
    </label>
</div>

<!-- Verde Bosque -->
<div class="tema-opcion" data-color="#2d5a3d" data-color-oscuro="#265233" data-color-texto="#ffffff" data-color-botones="#1c9346" style="background-color: #2d5a3d;">
    <span class="tema-texto">Verde Bosque</span>
    <label class="tema-interruptor">
        <input type="checkbox">
        <span class="tema-slider"></span>
    </label>
</div>

<!-- Violeta Oscuro -->
<div class="tema-opcion" data-color="#3e1f47" data-color-oscuro="#2e152e" data-color-texto="#ffffff" data-color-botones="#8e44ad" style="background-color: #3e1f47;">
    <span class="tema-texto">Violeta Oscuro</span>
    <label class="tema-interruptor">
        <input type="checkbox">
        <span class="tema-slider"></span>
    </label>
</div>

<!-- Tema Pastel: Rosa Claro -->
<div class="tema-opcion" data-color="#ffcccb" data-color-oscuro="#eba7a6" data-color-texto="#000000" data-color-botones="#ff6f61" style="background-color: #ffcccb;">
    <span class="tema-texto">Rosa Claro</span>
    <label class="tema-interruptor">
        <input type="checkbox">
        <span class="tema-slider"></span>
    </label>
</div>

<!-- Tema Pastel: Azul Claro -->
<div class="tema-opcion" data-color="#a2d5f2" data-color-oscuro="#8fbad9" data-color-texto="#000000" data-color-botones="#3498db" style="background-color: #a2d5f2;">
    <span class="tema-texto">Azul Claro</span>
    <label class="tema-interruptor">
        <input type="checkbox">
        <span class="tema-slider"></span>
    </label>
</div>

<!-- Tema Pastel: Verde Menta -->
<div class="tema-opcion" data-color="#b2f2bb" data-color-oscuro="#9ed9a7" data-color-texto="#000000" data-color-botones="#2ecc71" style="background-color: #b2f2bb;">
    <span class="tema-texto">Verde Menta</span>
    <label class="tema-interruptor">
        <input type="checkbox">
        <span class="tema-slider"></span>
    </label>
</div>
    
        
    </div>

  <!-- Botón de Volver (fijo) -->
<button class="btn-volver-configuracion">
    <span class="btn-icon">⬅️</span>
    <span class="btn-text">Volver</span>
</button>
</div>


<div class="menu-configuracion" id="menu-sonido">
        <center><h2>Cuenta</h2></center>
        <div class="pasta">
            <div class="pizza">
                <p id="nombre_usuario">Nombre: Cargando...</p>
            </div>
            <div class="lasagna">
                <p id="apellidos">Apellidos: Cargando...</p>
            </div>
            <div class="risotto">
                <p id="correo">Correo: Cargando...</p>
            </div>
            <div class="gelato">
                <p id="telefono">Teléfono: Cargando...</p>
            </div>
        </div>
        <button class="btn-volver-configuracion" id="btn-volver">
            <span class="btn-icon">⬅️</span>
            <span class="btn-text">Volver</span>
        </button>
    </div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Al enviar el formulario de login
        $('#form-login').on('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe de la manera tradicional

            // Obtener los valores del formulario
            var nombre = $('#nombre').val();
            var password = $('#password').val();

            // Hacer la solicitud AJAX al archivo login.php
            $.ajax({
                url: 'login.php', // Archivo PHP que validará el login
                type: 'POST',
                data: {
                    nombre: nombre,
                    password: password
                },
                success: function(response) {
                    // Verificar si la respuesta es exitosa
                    if (response.success) {
                        // Si el login fue exitoso, mostrar la sección de datos de usuario
                        $('#menu-sonido').show();
                        $('#panel-login').hide();

                        // Mostrar los datos del usuario en los cuadros
                        $('#nombre_usuario').text('Nombre: ' + response.nombre);
                        $('#apellidos').text('Apellidos: ' + response.apellidos);
                        $('#correo').text('Correo: ' + response.correo);
                        $('#telefono').text('Teléfono: ' + response.telefono);
                    } else {
                        // Si el login falla, mostrar un mensaje de error
                        alert('Credenciales incorrectas, por favor intenta de nuevo');
                    }
                },
                error: function() {
                    alert('Hubo un error en la conexión, intenta más tarde.');
                }
            });
        });

        // Volver al panel de login
        $('#btn-volver').on('click', function() {
            // Mostrar el formulario de login y ocultar la sección de cuenta
            $('#menu-sonido').hide();
            $('#panel-login').show();
            $('#nombre').val(''); // Limpiar campos de login
            $('#password').val('');
        });
    });
</script>



    <div class="menu-configuracion" id="menu-politicas">
        <center><h2>Políticas de Uso/Privacidad</h2></center>
        <div class="politicas-contenido">
            <p>
                <center>  <h1>Política de Privacidad de Invernaderos Autónomos</h1> </center>
                <center><h5>Última actualización: 7 de marzo de 2025</h5> </center>
En Invernaderos Autónomos valoramos profundamente la privacidad y la seguridad de tus datos personales. Esta política de privacidad explica detalladamente cómo recopilamos, utilizamos, compartimos y protegemos la información que nos proporcionas cuando usas nuestros servicios y productos. Además, se detallan tus derechos y opciones en relación con el tratamiento de tus datos personales.
Nos comprometemos a ser transparentes sobre el uso que hacemos de tus datos, de acuerdo con las leyes y regulaciones internacionales sobre privacidad y protección de datos, como el Reglamento General de Protección de Datos (GDPR) de la Unión Europea, la Ley de Protección de la Privacidad del Consumidor de California (CCPA), y las leyes locales aplicables en otras jurisdicciones.
1. Información que Recopilamos
En Invernaderos Autónomos recopilamos varios tipos de información con el fin de ofrecerte un servicio más eficiente y personalizado.
<br><br>
 A continuación, detallamos las categorías de datos que recopilamos:
 <br><br>
<h3>1.1 Datos Personales de Identificación</h3>
<br>
Para ofrecerte una experiencia personalizada y permitir el acceso a tus servicios, recopilamos:
•	Nombre y apellidos: Utilizados para personalizar las interacciones y garantizar que las comunicaciones sean claras y dirigidas correctamente.
•	Número de teléfono: Es utilizado para contactarte en caso de que sea necesario proporcionarte información urgente sobre el funcionamiento de tu equipo.
•	Correo electrónico: Este dato es esencial para enviarte actualizaciones relacionadas con el sistema automatizado de tu invernadero y otros avisos importantes relacionados con los servicios que ofrecemos.
•	Contraseña de la cuenta: Se utiliza para asegurar que solo tú tengas acceso a tu cuenta. Tu contraseña está protegida mediante técnicas de encriptación.
<br><br>
<h3>1.2 Datos de Uso del Sistema</h3>
<br>
Además de la información personal mencionada, recopilamos ciertos datos sobre cómo interactúas con nuestros servicios, como:
•	Tipo de dispositivo y sistema operativo: Para optimizar nuestros servicios y asegurarnos de que nuestra plataforma sea accesible en todos los dispositivos y sistemas operativos.
•	Dirección IP: La dirección IP se utiliza para la gestión de seguridad y análisis de uso.
•	Logs de actividad en la plataforma: Incluye detalles sobre las interacciones con nuestra plataforma y las acciones realizadas en el sistema de automatización del invernadero.
<br><br>
<h3>1.3 Información Técnica</h3>
<br>
Utilizamos ciertas herramientas para facilitar la navegación en nuestra plataforma, lo que nos permite optimizar la experiencia del usuario:
•	Cookies: Pequeños archivos que almacenan información sobre tu actividad de navegación y preferencias.
•	Tecnologías de seguimiento: Como las etiquetas de píxeles y scripts que nos permiten analizar el comportamiento de los usuarios en nuestra plataforma y mejorar nuestros servicios.
<br><br>
<h3>2. Cómo Usamos Tu Información</h3>
<br>
Los datos que recopilamos son esenciales para ofrecerte un servicio eficiente y para mejorar nuestra plataforma. A continuación se detallan los usos principales de la información que recolectamos:
<br><br>
<h3>2.1 Proveer Nuestros Servicios</h3>
<br>
Usamos tus datos para:
•	Gestionar tu cuenta: Creación, acceso y administración de tu cuenta en nuestra plataforma.
•	Automatizar el sistema de invernadero: Te enviamos notificaciones y actualizaciones sobre el funcionamiento de tu equipo y cualquier evento que requiera atención, como un fallo del sistema o mantenimiento preventivo.
•	Soporte técnico: Utilizamos tu información de contacto para brindarte asistencia en caso de problemas con tu equipo de automatización o con el acceso a tu cuenta.
<br><br>
<h3>2.2 Notificaciones y Comunicaciones</h3>
<br>
•	Notificaciones por correo electrónico o SMS: Enviaremos actualizaciones periódicas y alertas sobre el funcionamiento del sistema automatizado, mejoras, nuevos servicios o cambios importantes.
•	Comunicaciones de marketing: Con tu consentimiento explícito, podríamos enviarte información sobre nuevas funcionalidades, ofertas especiales y promociones relacionadas con los servicios de automatización.
<br><br>
<h3>2.3 Seguridad y Mejora del Servicio</h3>
<br>
•	Protección de datos: Utilizamos la información para proteger tu cuenta contra accesos no autorizados y prevenir fraudes.
•	Análisis de uso: Los datos de uso son analizados para mejorar la experiencia de los usuarios en nuestra plataforma, hacer mejoras en el diseño y la funcionalidad del sistema y garantizar su correcta operación.
<br><br>
<h3>3. Cómo Protegemos Tu Información</h3>
<br>
La seguridad de tus datos es una de nuestras principales prioridades. Utilizamos las mejores prácticas en seguridad para proteger la información que recopilamos.
<br><br>
<h3>3.1 Medidas de Seguridad</h3>
<br>
Implementamos una serie de medidas técnicas y organizativas para garantizar la confidencialidad, integridad y disponibilidad de los datos personales. Algunas de las medidas incluyen:
•	Cifrado de datos: Toda la información sensible (como contraseñas y detalles de pago) se cifra mediante tecnología de encriptación de alta calidad para evitar el acceso no autorizado.
•	Autenticación de dos factores (2FA): Te ofrecemos la opción de habilitar una capa adicional de seguridad en tu cuenta.
•	Acceso restringido: Solo personal autorizado y con necesidad de acceso tiene permisos para visualizar o gestionar tus datos personales.
<br><br>
<h3>3.2 Evaluaciones y Auditorías</h3>
<br>
Realizamos auditorías periódicas de seguridad para garantizar que nuestros sistemas sean seguros y estén protegidos contra cualquier vulnerabilidad. Esto incluye pruebas de penetración, análisis de vulnerabilidades y revisiones de cumplimiento normativo.
<br><br>
<h3></h3>4. Compartir Tu Información</h3>
<br>
En Invernaderos Autónomos, respetamos tu privacidad. No vendemos ni alquilamos tus datos personales a terceros. Sin embargo, es posible que compartamos tu información en las siguientes circunstancias:
<br><br>
<h3>4.1 Proveedores de Servicios</h3>
<br>
Podemos compartir tus datos con terceros proveedores de servicios que nos ayuden a operar nuestra plataforma, procesar pagos, enviar notificaciones o realizar análisis. Estos proveedores están obligados a mantener la confidencialidad de la información y solo usarla para los fines acordados.
<br><br>
<h3>4.2 Cumplimiento Legal</h3>
<br>
Si nos vemos obligados a hacerlo por ley, o si creemos que es necesario para proteger nuestros derechos, tu seguridad, la de otros usuarios o para cumplir con procedimientos legales, podemos divulgar tu información personal.
<br><br>
<h3>5. Tus Derechos Sobre Tu Información</h3>
<br><br>
<h3>Tienes derecho a:</h3>
<br>
•	Acceder a tus datos personales: Puedes obtener una copia de los datos que tenemos sobre ti, en cualquier momento, solicitándola.<br><br><br>
•	Rectificar tu información: Si alguna de tus datos personales es incorrecta o está incompleta, puedes solicitar que la corrijamos.<br><br><br>
•	Eliminar tu cuenta: Si decides que ya no deseas usar nuestros servicios, puedes solicitar la eliminación de tu cuenta y de los datos asociados.<br><br><br>
•	Oponerte al tratamiento de tus datos: Puedes revocar tu consentimiento para el envío de comunicaciones de marketing o de otro tipo, si lo prefieres.<br><br><br>
Para ejercer estos derechos, por favor contáctanos utilizando los detalles que se encuentran en la sección Contacto más abajo.
<br><br><br>
<h3>6. Uso de Cookies y Tecnologías Similares</h3>
<br><br>
<h3>6.1 Qué Son las Cookies</h3>
<br>
Las cookies son pequeños archivos que se almacenan en tu dispositivo mientras navegas por nuestra plataforma. Utilizamos cookies para mejorar tu experiencia de usuario, recordar tus preferencias y optimizar nuestras campañas de marketing.
<br><br>
<h3>6.2 Cómo Gestionar las Cookies</h3>
<br>
Puedes configurar tu navegador para que te notifique cuando se establezcan cookies o para bloquearlas completamente. Sin embargo, si decides desactivar las cookies, algunas funcionalidades de nuestro sitio podrían no estar disponibles o no funcionar correctamente.
<br><br>
<h3>7. Transferencia Internacional de Datos</h3>
<br>
Si resides fuera del país donde se encuentra nuestra sede, tus datos pueden ser transferidos, almacenados y procesados en otros países. En Invernaderos Autónomos, garantizamos que se aplican las mismas medidas de protección de datos, independientemente de la ubicación de nuestros servidores.
<br><br>
<h3>8. Cambios en Esta Política de Privacidad</h3>
<br>
Nos reservamos el derecho de modificar esta Política de Privacidad en cualquier momento. Cualquier cambio será publicado en esta página, y si es necesario, se te notificará de manera destacada. Te recomendamos que revises esta política regularmente para estar al tanto de cualquier cambio.
<br><br>
<h3><center>Si tienes preguntas o inquietudes sobre esta Política de Privacidad o sobre el manejo de tus datos personales, no dudes en contactarnos:</h3></center><br>
<center>•	Correo electrónico: invernaderosautonomos@gmail.com<br><br><br>
•	Teléfono: +55 (775) 1349321<br><br><br>
</center>
<center><h10>Tambien puedes encontrar estos datos en el pie de pagina de tu consola de desarrollo o en tu manual de instrucciones de tu dispositivo</h10></center>

            </p>
            
        </div>
        <button class="btn-volver-configuracion">
            <span class="btn-icon">⬅️</span>
            <span class="btn-text">Volver</span>
        </button>
    </div>

    <div class="menu-configuracion" id="menu-dispositivos">
        <center><h2>Administrar Dispositivos</h2></center>
        <button class="btn-volver-configuracion">
            <span class="btn-icon">⬅️</span>
            <span class="btn-text">Volver</span>
        </button>
    </div>

    <div class="menu-configuracion" id="menu-animaciones">
        <center><h2>Opciones de Animaciones</h2></center>
        <button class="btn-volver-configuracion">
            <span class="btn-icon">⬅️</span>
            <span class="btn-text">Volver</span>
        </button>
    </div>

    <div class="menu-configuracion" id="menu-reestablecer">
        <center><h2>Opciones de Sonido</h2></center>
        <button class="btn-volver-configuracion">
            <span class="btn-icon">⬅️</span>
            <span class="btn-text">Volver</span>
        </button>
    </div>








    <!-- Footer -->
    <footer>
        <div class="footer-contacto">
            <p>Contáctanos</p>
        </div>
        <div class="footer-contenido">
            <div class="footer-izquierda">
                <p>invernaderosautonomos@gmail.com</p>
         
                <p><br></p>
            </div>
            <div class="footer-derecha">
                <p>+52 775 134 9321</p>
            
                <p><br></p>
            </div>
        </div>
    </footer>

    <!-- Sonidos -->
<audio id="hover-sound" src="click.wav" preload="auto"></audio>
<audio id="click-sound" src="click_sound.wav" preload="auto"></audio>
<audio id="back-sound" src="back_sound.wav" preload="auto"></audio>
<audio id="registrar-iniciar-sound" src="registrar_iniciar_sound.wav" preload="auto"></audio>
<audio id="tema-sound" src="tema_sound.wav" preload="auto"></audio> <!-- Nuevo sonido para los interruptores -->

    <script src="script.js"></script>
</body>
</html>   