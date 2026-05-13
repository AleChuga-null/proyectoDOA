

// función de cambio
function mostrarContenido(seccion) {
    // buscar y ocultar bloques
    const bloques = document.querySelectorAll('.contenido-flex');
    bloques.forEach(bloque => {
        bloque.style.display = 'none';
    });

    // mostrar solo el que se ha pulsado
    document.getElementById('bloque-' + seccion).style.display = 'flex';

    // quitar 'active' y ponerlo al pulsado
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });

    document.getElementById('btn-' + seccion).classList.add('active');


    // cambio del título h2
    const h2 = document.getElementById('encabezado-principal');

    switch (seccion) {
    case'mision':
        h2.innerText = "¿Quiénes Somos?";
        break;

    case 'vision':
        h2.innerText = "Hacia dónde vamos";
        break;

    case 'valores':
        h2.innerText = "";
    }
}