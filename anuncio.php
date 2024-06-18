<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado"> 
        <h1 class="titulo-index">Casa en Venta frente al Bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>
            <p>Descubre tu refugio ideal en esta magnífica casa frente al bosque, donde la naturaleza y el confort se fusionan en perfecta armonía. Con un diseño arquitectónico contemporáneo que maximiza la luz natural y las vistas panorámicas, esta residencia ofrece espacios amplios y acogedores, como una sala de estar con chimenea, una cocina gourmet equipada con electrodomésticos de alta gama y dormitorios luminosos con balcones privados. Disfruta de la tranquilidad desde la terraza y el jardín paisajístico, con acceso directo a senderos naturales para caminatas y ciclismo. Vive rodeado de belleza natural y privacidad, sin renunciar a la comodidad y el lujo moderno.</p>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>