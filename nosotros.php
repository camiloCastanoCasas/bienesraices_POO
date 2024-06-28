<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion"> 
        <h1 class="titulo-index">Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quos aut odio officiis eaque obcaecati facilis, id, quidem necessitatibus animi totam reprehenderit quod quas cupiditate saepe! Iste quos alias distinctio. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam accusamus delectus consectetur iure doloribus, nesciunt optio, impedit expedita ducimus officia sunt earum aliquid? Rerum deserunt consequuntur eaque excepturi saepe? Porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem accusamus corrupti voluptatibus quam, perferendis officia? Quaerat, delectus dolorem sint impedit laborum deleniti, nam explicabo fugiat inventore dicta modi quos rem!</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion"> 
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
    </section>
<?php 
    incluirTemplate('footer');
?>
