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
    
    /*Comprobamos si el modo oscuro esta activado en el navegador*/

    //Si el usuario ya eligio un tema, lo respetamos
    const darkModePreference = localStorage.getItem('dark-mode');
    //Si no eligio un tema, respetamos la preferencia del sistema operativo
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    const isDarkModeEnabled = darkModePreference === 'true' || (darkModePreference === null && prefiereDarkMode.matches);
    
    //Si esta activado, lo activamos
    document.body.classList.toggle('dark-mode', isDarkModeEnabled);
    
    //Preferencia de modo oscuro en el navegador, cambia en tiempo real. Solo si no se ha elegido un tema.
    prefiereDarkMode.addEventListener('change', function(){
        if(localStorage.getItem('dark-mode') === null){
            if(prefiereDarkMode.matches){
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.remove('dark-mode');
            }
        }
    });
    
    //Boton para activar el modo oscuro
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');

        //Guardamos el modo en local storage
        if(document.body.classList.contains('dark-mode')){
            localStorage.setItem('dark-mode', 'true');
        } else {  
            localStorage.setItem('dark-mode', 'false');
        }
    });
}