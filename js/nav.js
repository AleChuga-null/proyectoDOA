// -- nav activo en sección actual --
const secciones = document.querySelectorAll('section, footer');
const enlacesNav = document.querySelectorAll('nav .botón-sección');

const observador = new IntersectionObserver((entradas) => {
    entradas.forEach(entrada => {
        if (entrada.isIntersecting) {
            const idSeccion = entrada.target.getAttribute('id');

            enlacesNav.forEach(enlace => {
                enlace.classList.remove('activo');
                if (enlace.getAttribute('href') === '#' + idSeccion) {
                    enlace.classList.add('activo');
                }
            });
        }
    });
}, {
    threshold: 0.45
});

secciones.forEach(seccion => observador.observe(seccion));
