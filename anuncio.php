<?php 

    //Obtener el ID de la URL
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /');
    }

    require 'includes/app.php';

    //Conexión a la base de datos
    $db = conectarDB();

    //Consultar la propiedad en la base de datos
    $query = "SELECT * FROM propiedades WHERE id_propiedad = $id";

    //Obtener el resultado
    $resultado = mysqli_query($db, $query);

    //Valida que la propiedad existe en la base de datos con ese ID
    if(!$resultado->num_rows){
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado"> 
        <h1 class="titulo-index"><?php echo $propiedad['nombre']?></h1>

        <img src="/imagenes/<?php echo $propiedad['imagen']?>" alt="">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio']?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad['habitaciones']?></p>
                </li>
            </ul>
            <p><?php echo $propiedad['descripcion']?></p>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>