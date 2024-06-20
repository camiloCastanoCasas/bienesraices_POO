<?php
    //Conexión a la base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    //Consultar las propiedades en la base de datos
    $query = "SELECT * FROM propiedades LIMIT $limite";

    //Obtener el resultado
    $resultado = mysqli_query($db, $query);

?>


<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">
        <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Anuncio" lazy="loading">
        <div class="contenido-anuncio">
            <div class="descripcion-anuncio">
                <h3><?php echo $propiedad['nombre']; ?></h3>
                <p class="descripcion">
                    <?php 
                    if (strlen($propiedad['descripcion']) > 100){
                        $descripcion = substr($propiedad['descripcion'], 0, 100) . "...";
                        echo $descripcion;
                    } else {
                        echo $propiedad['descripcion'];
                    }
                    ?>
                </p>
                <p class="precio">$<?php echo $propiedad['precio']; ?></p>
            </div>

            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="Icono baño" lazy="loading">
                    <p><?php echo $propiedad['wc'];?></p>
                </li>
                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" lazy="loading">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" lazy="loading">
                    <p><?php echo $propiedad['habitaciones'];?></p>
                </li>
            </ul>

            <a href="anuncio.php?id=<?php echo $propiedad['id_propiedad']?>" class="boton-azul-block">
                Ver Propiedad
            </a>

        </div>
    </div> <!--.anuncio-->
    <?php endwhile; ?>
</div>

<?php
    //Cerramos la conexión
    mysqli_close($db);
?>