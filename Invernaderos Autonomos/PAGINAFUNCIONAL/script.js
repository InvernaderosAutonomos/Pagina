// Seleccionar todos los botones
const botones = document.querySelectorAll('button');
const hoverSound = document.getElementById('hover-sound');
const clickSound = document.getElementById('click-sound');
const backSound = document.getElementById('back-sound');
const temaSound = document.getElementById('tema-sound'); // Nuevo sonido para los interruptores

// Elementos de la pantalla principal
const mainContent = document.querySelector('main.consola');
const btnConfiguracion = document.getElementById('btn-configuracion');

// Elementos de la pantalla de configuración
const nuevoContenidoConfiguracion = document.getElementById('nuevo-contenido');
const btnVolverConfiguracion = document.getElementById('btn-volver');
const configuracionOpciones = document.querySelector('.configuracion-opciones');
const botonesCarrusel = document.querySelectorAll('.configuracion-opciones .btn-configuracion');
let currentIndex = 0;

// Seleccionar todos los interruptores (checkboxes) de los temas
const interruptores = document.querySelectorAll('.tema-opcion input[type="checkbox"]');

// Función para actualizar el contenido del panel
function actualizarContenidoPanel(contenido) {
    const contenidoDinamico = document.getElementById("contenido-dinamico");
    contenidoDinamico.innerHTML = contenido;
}






// Ejemplo de uso: Agregar contenido al panel
function agregarContenidoAlPanel() {
    const nuevoContenido = `
        <h3>Nueva Sección</h3>
        <p>Este es un nuevo contenido agregado dinámicamente.</p>
        <button class="btn-consola" onclick="mostrarAlerta()">Haz clic aquí</button>
    `;
    actualizarContenidoPanel(nuevoContenido);
}

// Ejemplo de uso: Quitar contenido del panel
function quitarContenidoDelPanel() {
    actualizarContenidoPanel("<p>El contenido ha sido eliminado.</p>");
}

// Función de ejemplo para mostrar una alerta
function mostrarAlerta() {
    alert("¡Botón clickeado!");
}

// Mostrar el panel con contenido dinámico
document.getElementById("panel-izquierdo").addEventListener("click", function () {
    // Agregar contenido inicial al panel
    actualizarContenidoPanel(`
        <h3>Estado de Conexión</h3>
        <p>Conectado <span class="indicador-conexion" style="background-color: green;"></span></p>
        <button class="btn-consola" onclick="agregarContenidoAlPanel()">Agregar Contenido</button>
        <button class="btn-consola" onclick="quitarContenidoDelPanel()">Quitar Contenido</button>
    `);

    // Mostrar el panel
    const nuevoPanel = document.getElementById("menu-panel-izquierdo");
    document.body.appendChild(nuevoPanel);
    nuevoPanel.classList.add("mostrar");
    clickSound.play();
});

document.addEventListener("DOMContentLoaded", function () {
    const panelIzquierdo = document.getElementById("panel-izquierdo");
    const nuevoPanel = document.getElementById("menu-panel-izquierdo");
    const hoverSound = document.getElementById("hover-sound");
    const clickSound = document.getElementById("click-sound");
    const backSound = document.getElementById("back-sound");

    // Animación de interactividad (hover)
    panelIzquierdo.addEventListener("mouseenter", function () {
        panelIzquierdo.style.transform = "scale(1.05)";
        panelIzquierdo.style.transition = "transform 0.3s ease";
        hoverSound.play();
    });

    panelIzquierdo.addEventListener("mouseleave", function () {
        panelIzquierdo.style.transform = "scale(1)";
    });

    // Mostrar el panel al hacer clic
    panelIzquierdo.addEventListener("click", function () {
        nuevoPanel.classList.add("mostrar");
        clickSound.play();
    });

    // Ocultar el panel al hacer clic en "Volver"
    document.addEventListener("click", function (event) {
        if (event.target.closest(".btn-volver-configuracion")) {
            nuevoPanel.classList.remove("mostrar");
            backSound.play();
        }
    });
});




document.addEventListener("DOMContentLoaded", function () {
    const panelDerecho = document.getElementById("panel-derecho");
    const nuevoPanel = document.getElementById("menu-panel-derecho");
    const hoverSound = document.getElementById("hover-sound");
    const clickSound = document.getElementById("click-sound");
    const backSound = document.getElementById("back-sound");

    // Animación de interactividad (hover)
    panelDerecho.addEventListener("mouseenter", function () {
        panelDerecho.style.transform = "scale(1.05)";
        panelDerecho.style.transition = "transform 0.3s ease";
        hoverSound.play();
    });

    panelDerecho.addEventListener("mouseleave", function () {
        panelDerecho.style.transform = "scale(1)";
    });

    // Mostrar el panel al hacer clic
    panelDerecho.addEventListener("click", function () {
        nuevoPanel.classList.add("mostrar");
        clickSound.play();
    });

    // Ocultar el panel al hacer clic en "Volver"
    document.addEventListener("click", function (event) {
        if (event.target.closest(".btn-volver-configuracion")) {
            nuevoPanel.classList.remove("mostrar");
            backSound.play();
        }
    });
});

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

// Variables para el control táctil
let touchStartY = 0; // Posición inicial del toque
let touchCurrentY = 0; // Posición actual del toque
let isSwiping = false; // Para detectar si el usuario está deslizando
let carruselOffset = 0; // Desplazamiento actual del carrusel

// Función para guardar el tema seleccionado en localStorage
function guardarTema(colorPrincipal, colorOscuro, colorTexto, colorBotones) {
    localStorage.setItem('tema', JSON.stringify({
        colorPrincipal,
        colorOscuro,
        colorTexto,
        colorBotones,
    }));
}

// Función para cargar el tema guardado desde localStorage
function cargarTema() {
    const temaGuardado = localStorage.getItem('tema');
    if (temaGuardado) {
        const tema = JSON.parse(temaGuardado);
        cambiarColores(tema.colorPrincipal, tema.colorOscuro, tema.colorTexto, tema.colorBotones);
        marcarTemaSeleccionado(tema.colorPrincipal);
    }
}

// Función para marcar el tema seleccionado en la interfaz
function marcarTemaSeleccionado(colorPrincipal) {
    interruptores.forEach(interruptor => {
        const casilla = interruptor.closest('.tema-opcion');
        if (casilla.getAttribute('data-color') === colorPrincipal) {
            interruptor.checked = true;
        } else {
            interruptor.checked = false;
        }
    });
}

// Función para cambiar el color de fondo, texto, botones y ajustar el footer, encabezado y paneles
function cambiarColores(colorPrincipal, colorOscuro, colorTexto, colorBotones) {
    console.log("Cambiando colores. Color principal:", colorPrincipal, "Color oscuro:", colorOscuro, "Color texto:", colorTexto, "Color botones:", colorBotones);

    // Cambiar el color de fondo del body
    document.body.style.backgroundColor = colorPrincipal;

    // Cambiar el color del texto del body
    document.body.style.color = colorTexto;

    // Aplicar el color oscuro al encabezado, footer y paneles
    const header = document.querySelector('header');
    const footer = document.querySelector('footer');
    if (colorPrincipal === '#f5f5f5') {
        // Tema Original: Tomar colores del HTML
        header.style.backgroundColor = header.getAttribute('data-color');
        footer.style.backgroundColor = footer.getAttribute('data-color');
        header.style.color = header.getAttribute('data-color-texto');
        footer.style.color = footer.getAttribute('data-color-texto');
    } else {
        // Otros temas: Usar colores de la casilla
        header.style.backgroundColor = colorOscuro;
        footer.style.backgroundColor = colorOscuro;
        header.style.color = colorTexto;
        footer.style.color = colorTexto;
    }

    document.querySelectorAll('.panel, .menu-configuracion').forEach(panel => {
        panel.style.backgroundColor = colorOscuro;
        panel.style.color = colorTexto;
    });

    // Cambiar el color de los botones y el carrusel
    document.querySelectorAll('button').forEach(boton => {
        if (colorPrincipal === '#f5f5f5') {
            // Tema Original: Tomar colores del HTML
            const botonColor = boton.getAttribute('data-color-botones') || '#2c3e50';
            const botonTexto = boton.getAttribute('data-color-texto') || '#ffffff';
            boton.style.backgroundColor = botonColor;
            boton.style.color = botonTexto;
        } else {
            // Otros temas: Usar colores de la casilla
            boton.style.backgroundColor = colorBotones;
            boton.style.color = colorTexto;
        }
    });

    // Cambiar el color de los botones del carrusel
    document.querySelectorAll('.configuracion-opciones .btn-configuracion').forEach(boton => {
        if (colorPrincipal === '#f5f5f5') {
            // Tema Original: Letras en blanco
            boton.style.color = '#ffffff';
        } else {
            // Otros temas: Usar colores de la casilla
            boton.style.color = colorTexto;
        }
        boton.style.backgroundColor = colorBotones;
    });
}

// Función para restaurar el color original
function restaurarColorOriginal() {
    console.log("Restaurando colores originales");

    // Restaurar el color de fondo del body
    document.body.style.backgroundColor = '#f5f5f5'; // Color original
    document.body.style.color = '#333'; // Color de texto original

    // Restaurar el color del footer y el encabezado
    const header = document.querySelector('header');
    const footer = document.querySelector('footer');
    header.style.backgroundColor = header.getAttribute('data-color');
    footer.style.backgroundColor = footer.getAttribute('data-color');
    header.style.color = header.getAttribute('data-color-texto');
    footer.style.color = footer.getAttribute('data-color-texto');

    // Restaurar el color de los paneles
    document.querySelectorAll('.panel, .menu-configuracion').forEach(panel => {
        panel.style.backgroundColor = '#ffffff'; // Color original (blanco)
        panel.style.color = '#333'; // Color de texto original (gris oscuro)
    });

    // Restaurar el color de los botones
    document.querySelectorAll('button').forEach(boton => {
        const botonColor = boton.getAttribute('data-color-botones') || '#2c3e50';
        const botonTexto = boton.getAttribute('data-color-texto') || '#ffffff';
        boton.style.backgroundColor = botonColor;
        boton.style.color = botonTexto;
    });

    // Restaurar el color de los botones del carrusel
    document.querySelectorAll('.configuracion-opciones .btn-configuracion').forEach(boton => {
        boton.style.backgroundColor = '#2c3e50'; // Color original de los botones (azul oscuro)
        boton.style.color = '#ffffff'; // Texto blanco en los botones
    });

    // Guardar el tema original en localStorage
    guardarTema('#f5f5f5', '#ffffff', '#333', '#2c3e50');
}

// Función para desactivar otros interruptores y cambiar el color
function desactivarOtrosInterruptores(interruptorActual) {
    interruptores.forEach(interruptor => {
        if (interruptor !== interruptorActual) {
            interruptor.checked = false; // Desactivar otros interruptores
        }
    });

    // Obtener los colores del tema seleccionado
    const casilla = interruptorActual.closest('.tema-opcion');
    const colorPrincipal = casilla.getAttribute('data-color');
    const colorOscuro = casilla.getAttribute('data-color-oscuro');
    const colorTexto = casilla.getAttribute('data-color-texto');
    const colorBotones = casilla.getAttribute('data-color-botones');
    console.log("Color principal:", colorPrincipal, "Color oscuro:", colorOscuro, "Color texto:", colorTexto, "Color botones:", colorBotones);

    // Reproducir el sonido de los interruptores
    temaSound.currentTime = 0; // Reiniciar el sonido si ya está reproduciéndose
    temaSound.play(); // Reproducir el sonido de los interruptores

    // Si el tema seleccionado es el "Tema Original", restaurar los colores originales
    if (colorPrincipal === '#f5f5f5') {
        restaurarColorOriginal();
    } else {
        // Cambiar los colores
        cambiarColores(colorPrincipal, colorOscuro, colorTexto, colorBotones);

        // Guardar el tema seleccionado en localStorage
        guardarTema(colorPrincipal, colorOscuro, colorTexto, colorBotones);
    }
}

// Agregar evento a cada interruptor
interruptores.forEach(interruptor => {
    interruptor.addEventListener('change', () => {
        if (interruptor.checked) {
            desactivarOtrosInterruptores(interruptor); // Desactivar otros interruptores y cambiar el color
        } else {
            restaurarColorOriginal(); // Restaurar el color original si se desactiva el interruptor
        }
    });
});

// Cargar el tema guardado al iniciar la página
document.addEventListener('DOMContentLoaded', () => {
    const temaGuardado = localStorage.getItem('tema');
    if (temaGuardado) {
        const tema = JSON.parse(temaGuardado);
        cambiarColores(tema.colorPrincipal, tema.colorOscuro, tema.colorTexto, tema.colorBotones);
        marcarTemaSeleccionado(tema.colorPrincipal);
    } else {
        // Si no hay tema guardado, aplicar el tema original por defecto
        restaurarColorOriginal();
        marcarTemaSeleccionado('#f5f5f5');
    }
});

// Función para actualizar la posición de los botones del carrusel
function updateButtons() {
    botonesCarrusel.forEach((boton, index) => {
        boton.classList.remove('active');
        const offset = (index - currentIndex + botonesCarrusel.length) % botonesCarrusel.length;

        if (offset === 0) {
            // Botón central (activo)
            boton.style.transform = `translateY(${carruselOffset}px) scale(1.2)`;
            boton.style.opacity = 1;
            boton.classList.add('active');
            boton.style.pointerEvents = 'auto'; // Habilitar interacción
        } else if (offset === 1) {
            // Botón superior (inactivo)
            boton.style.transform = `translateY(${carruselOffset - 150}px) scale(0.9)`; // Más separado hacia arriba
            boton.style.opacity = 0.6;
            boton.style.pointerEvents = 'none'; // Deshabilitar interacción
        } else if (offset === botonesCarrusel.length - 1) {
            // Botón inferior (inactivo)
            boton.style.transform = `translateY(${carruselOffset + 150}px) scale(0.9)`; // Más separado hacia abajo
            boton.style.opacity = 0.6;
            boton.style.pointerEvents = 'none'; // Deshabilitar interacción
        } else {
            // Otros botones (ocultos)
            boton.style.transform = `translateY(${carruselOffset}px) scale(0)`;
            boton.style.opacity = 0;
            boton.style.pointerEvents = 'none'; // Deshabilitar interacción
        }
    });
}

// Función para mover el carrusel
function moveCarousel(direction) {
    if (direction === 'next') {
        currentIndex = (currentIndex + 1) % botonesCarrusel.length; // Avanzar (opción siguiente)
    } else if (direction === 'prev') {
        currentIndex = (currentIndex - 1 + botonesCarrusel.length) % botonesCarrusel.length; // Retroceder (opción anterior)
    }
    updateButtons(); // Actualizar la posición de los botones
}

// Evento de rueda del mouse (para navegadores de escritorio)
configuracionOpciones.addEventListener('wheel', (event) => {
    event.preventDefault();
    if (event.deltaY > 0) {
        moveCarousel('prev'); // Girar hacia abajo -> mover hacia arriba (opción anterior)
    } else {
        moveCarousel('next'); // Girar hacia arriba -> mover hacia abajo (opción siguiente)
    }
});

// Eventos táctiles (para dispositivos móviles)
configuracionOpciones.addEventListener('touchstart', (event) => {
    touchStartY = event.touches[0].clientY; // Guardar la posición inicial del toque
    isSwiping = false; // Reiniciar el estado de deslizamiento
});

configuracionOpciones.addEventListener('touchmove', (event) => {
    event.preventDefault(); // Evitar el desplazamiento de la página
    touchEndY = event.touches[0].clientY; // Guardar la posición actual del toque

    // Calcular la distancia del deslizamiento
    const swipeDistance = touchEndY - touchStartY;

    // Si la distancia es significativa, se considera un deslizamiento
    if (Math.abs(swipeDistance) > 10) {
        isSwiping = true;
    }
});

configuracionOpciones.addEventListener('touchend', () => {
    const swipeDistance = touchEndY - touchStartY; // Calcular la distancia del deslizamiento
    const swipeThreshold = 50; // Umbral mínimo para considerar un deslizamiento

    // Solo mover el carrusel si el usuario estaba deslizando
    if (isSwiping && Math.abs(swipeDistance) > swipeThreshold) {
        if (swipeDistance > 0) {
            moveCarousel('next'); // Deslizar hacia abajo -> mover hacia abajo (opción siguiente)
        } else {
            moveCarousel('prev'); // Deslizar hacia arriba -> mover hacia arriba (opción anterior)
        }
    }

    // Reiniciar el estado de deslizamiento
    isSwiping = false;
});

// Inicializar el carrusel
updateButtons();

// Función para mostrar un menú de configuración
function mostrarMenu(event) {
    const boton = event.currentTarget;
    const menuId = boton.getAttribute('data-menu');
    const menu = document.getElementById(menuId);

    // Bloquear scroll
    document.body.classList.add('bloquear-scroll');

    // Ocultar el carrusel de configuración
    configuracionOpciones.classList.add('ocultar');

    // Mostrar el menú correspondiente
    setTimeout(() => {
        menu.classList.add('mostrar');
    }, 50);
}

// Función para ocultar un menú de configuración
function ocultarMenuConfiguracion() {
    // Ocultar todos los menús
    document.querySelectorAll('.menu-configuracion').forEach(menu => {
        menu.classList.remove('mostrar');
    });

    // Mostrar el carrusel de configuración
    setTimeout(() => {
        configuracionOpciones.classList.remove('ocultar');
    }, 300);

    // Desbloquear scroll
    document.body.classList.remove('bloquear-scroll');
}

// Animación al hacer clic en "Configuración"
btnConfiguracion.addEventListener('click', () => {
    clickSound.currentTime = 0;
    clickSound.play();

    mainContent.classList.add('fade-out');

    setTimeout(() => {
        mainContent.style.display = 'none';
        nuevoContenidoConfiguracion.style.display = 'flex';
        nuevoContenidoConfiguracion.classList.add('fade-in');
    }, 300);
});

// Animación al hacer clic en "Volver" (configuración)
btnVolverConfiguracion.addEventListener('click', () => {
    backSound.currentTime = 0;
    backSound.play();

    nuevoContenidoConfiguracion.classList.remove('fade-in');
    nuevoContenidoConfiguracion.classList.add('fade-out');

    setTimeout(() => {
        nuevoContenidoConfiguracion.style.display = 'none';
        nuevoContenidoConfiguracion.classList.remove('fade-out');
        mainContent.style.display = 'flex';
        mainContent.classList.remove('fade-out');
        mainContent.classList.add('fade-in');
    }, 300);

    setTimeout(() => {
        mainContent.classList.remove('fade-in');
    }, 600);
});

// Agregar evento de clic a todos los botones de configuración
document.querySelectorAll('.btn-configuracion:not(#btn-volver)').forEach(boton => {
    boton.addEventListener('click', mostrarMenu);
});

// Agregar evento de clic a todos los botones de "Volver" (configuración)
document.querySelectorAll('.btn-volver-configuracion').forEach(boton => {
    boton.addEventListener('click', () => {
        backSound.currentTime = 0;
        backSound.play();
        ocultarMenuConfiguracion();
    });
});

// Ajustar el volumen de los sonidos
hoverSound.volume = 0.5;
clickSound.volume = 0.5;
backSound.volume = 0.5;

// Precargar los sonidos al cargar la página
window.addEventListener('load', () => {
    hoverSound.load();
    clickSound.load();
    backSound.load();
});

// Agregar evento de hover a cada botón
botones.forEach(boton => {
    boton.addEventListener('mouseenter', () => {
        hoverSound.currentTime = 0;
        hoverSound.play();
    });

    boton.addEventListener('click', () => {
        clickSound.currentTime = 0;
        clickSound.play();
    });
});