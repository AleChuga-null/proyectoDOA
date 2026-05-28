// -- Cambio sección Nosotros --
function mostrarContenido(seccion) {
    document.getElementById('bloque-mision').style.display = 'none';
    document.getElementById('bloque-vision').style.display = 'none';
    document.getElementById('bloque-valores').style.display = 'none';

    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

    document.getElementById('bloque-' + seccion).style.display = 'flex';
    document.getElementById('btn-' + seccion).classList.add('active');
}