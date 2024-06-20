<?php 
    //Base de datos
    require '../includes/config/database.php';
    $db = conectarDB();

    //Obtener propiedades
    $consulta = "SELECT * FROM propiedades";

    //Consultar la base de datos
    $resultadoConsulta = mysqli_query($db, $consulta);

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    //Muestra mensaje condicional
    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if($id){
        //Eliminar imagen de la propiedad
        $query = "SELECT imagen FROM propiedades WHERE id_propiedad = $id";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink('../imagenes/' . $propiedad['imagen']);

        //Eliminar propiedad
        $query = "DELETE FROM propiedades WHERE id_propiedad = $id";
        $resultado = mysqli_query($db, $query);

        if($resultado){
            header('Location: /admin?resultado=3');
        }
    }
    require '../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion"> 
        <h1 class="titulo-index">Administrador de Bienes Raices</h1>
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Propiedad creada correctamente</p>
        <?php elseif(intval($resultado) === 2): ?>
            <p class="alerta exito">Propiedad actualizada correctamente</p>
        <?php elseif(intval($resultado) === 3): ?>
            <p class="alerta exito">Propiedad eliminada correctamente</p>
        <?php endif; ?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)):?>
                <tr>
                    <td><?php echo $propiedad['id_propiedad']?></td>
                    <td><?php echo $propiedad['nombre']?></td>
                    <td><img src="/imagenes/<?php echo $propiedad['imagen']?>" alt="" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad['precio']?></td>
                    <td class="botones">
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id_propiedad']?>" class="boton-azul-block">Actualizar</a>
                        <a href="admin/?id=<?php echo $propiedad['id_propiedad']?>" class="boton-rojo-block">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

<?php 

    //Cerrar la conexión
    mysqli_close($db);

    incluirTemplate('footer');
?>