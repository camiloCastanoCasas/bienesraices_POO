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
    require '../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion"> 
        <h1 class="titulo-index">Administrador de Bienes Raices</h1>
        <?php if(intval($resultado) === 1): ?>
            <p class="alerta exito">Propiedad creada correctamente</p>
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
                        <a href="#" class="boton-azul-block">Actualizar</a>
                        <a href="#" class="boton-rojo-block">Eliminar</a>
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