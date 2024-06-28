<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado"> 
        <h1 class="titulo-index">Guía para la decoración de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>12-06-2024</span> por: <span>Administrador</span></p>

        <div class="resumen-propiedad">
            <p>La "Guía para la decoración de tu hogar" es una herramienta esencial para transformar cualquier espacio en un reflejo de tu estilo y personalidad. Esta guía abarca desde la elección de colores y materiales, hasta la disposición de muebles y accesorios, ofreciendo consejos prácticos y tendencias actuales que te ayudarán a crear ambientes acogedores y funcionales. Con ideas innovadoras y sugerencias adaptadas a diferentes presupuestos, esta guía te permitirá maximizar el potencial de cada habitación, logrando un equilibrio perfecto entre estética y comodidad.</p>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>
