// Cuando cambia un selector, envía su formulario automáticamente
// para recargar la página con el nuevo valor seleccionado

document.getElementById("selector-titulacion").addEventListener("change", function() {
    document.getElementById("form-titulacion").submit();
});

document.getElementById("selector-nivel").addEventListener("change", function() {
    document.getElementById("form-nivel").submit();
});

document.getElementById("selector-asignatura").addEventListener("change", function() {
    document.getElementById("form-asignatura").submit();
});


// Confirmación antes de desmatricular
document.querySelectorAll(".btn-quitar").forEach(function(boton) {
    boton.addEventListener("click", function(e) {
        if (!confirm("¿Seguro que quieres desmatricular a este alumno?")) {
            e.preventDefault();
        }
    });
});