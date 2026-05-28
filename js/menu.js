// -- MENÚ HAMBURGUESA --
const btnMenu = document.getElementById('btn-menu');
const nav = document.querySelector('#cabecera nav');

btnMenu.addEventListener('click', () => {
    nav.classList.toggle('abierto');
});

document.querySelectorAll('.botón-sección').forEach(enlace => {
    enlace.addEventListener('click', () => {
        nav.classList.remove('abierto');
    });
});