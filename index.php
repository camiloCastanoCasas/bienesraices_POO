<?php 
    require 'includes/app.php';
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor seccion"> 
        <h1 class="titulo-index">Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono_seguridad.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Nos comprometemos a proporcionar a nuestros clientes información detallada y precisa sobre la seguridad de cada propiedad listada. Desde la ubicación hasta las medidas de seguridad incorporadas en el diseño y las instalaciones, cada aspecto se analiza meticulosamente para garantizar la tranquilidad y protección de quienes confían en nosotros para encontrar su hogar ideal o inversión.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono_dinero.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Nos especializamos en proporcionar evaluaciones precisas y justas basadas en análisis detallados del mercado local y tendencias actuales. Ya sea que estés buscando comprar, vender o alquilar, nuestro equipo está comprometido a asegurarse de que obtengas el mejor valor por tu inversión. Ofrecemos herramientas y recursos para ayudarte a entender mejor el mercado y tomar decisiones informadas sobre tus transacciones inmobiliarias.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono_tiempo.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Nos esforzamos por agilizar cada paso del proceso, desde la búsqueda inicial hasta el cierre de la transacción. Nuestro equipo está dedicado a proporcionar un servicio eficiente y efectivo, asegurando que encuentres la propiedad adecuada en el menor tiempo posible. Para vendedores, facilitamos la venta rápida y efectiva de sus propiedades mediante estrategias de comercialización efectivas y una red sólida de compradores potenciales.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2 class="titulo-anuncios">Casas y Apartamentos en Venta</h2>

        <?php 
            $limite = 3;
            include 'includes/anuncios.php'; 
        ?>      

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Contacta con nuestro equipo hoy mismo para recibir asesoramiento experto y comenzar tu búsqueda de tu próximo hogar o inversión.</p>
        <a href="contacto.html" class="boton-azul">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3> 
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>12-06-2024</span> por: <span>Administrador</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.</p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>12-06-2024</span> por: <span>Administrador</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.</p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    Gracias a su profesionalismo y dedicación, encontré mi hogar ideal más rápido de lo que esperaba. ¡Altamente recomendado!
                </blockquote>
                <p>- Juan Camilo Castaño</p>
            </div>
        </section>
    </div>
<?php 
    incluirTemplate('footer');
?>
