// Seleccionar todos los interruptores (checkboxes) de los temas
const interruptores = document.querySelectorAll('.tema-opcion input[type="checkbox"]');

// Función para desactivar otros interruptores
function desactivarOtrosInterruptores(interruptorActual) {
    interruptores.forEach(interruptor => {
        if (interruptor !== interruptorActual) {
            interruptor.checked = false; // Desactivar otros interruptores
        }
    });
}

// Agregar evento a cada interruptor
interruptores.forEach(interruptor => {
    interruptor.addEventListener('change', () => {
        if (interruptor.checked) {
            desactivarOtrosInterruptores(interruptor); // Desactivar otros interruptores
        }
    });
});