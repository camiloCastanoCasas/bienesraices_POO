document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
});

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
}

//Funcion para mostrar y ocultar la navegacion en dispositivos moviles
function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

//Funcion para activar el modo oscuro
function darkMode(){

    //Preferencia de modo oscuro en el sistema operativo
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    prefiereDarkMode.matches ? document.body.classList.add('dark-mode') : document.body.classList.remove('dark-mode');

    //Preferencia de modo oscuro en el navegador, cambia en tiempo real.
    prefiereDarkMode.addEventListener('change', function(){
        prefiereDarkMode.matches ? document.body.classList.add('dark-mode') : document.body.classList.remove('dark-mode');
    });
    
    //Boton para activar el modo oscuro
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    });
}