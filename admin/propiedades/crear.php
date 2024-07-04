<?php 

    require '../../includes/app.php';

    use App\Propiedad;

    //Importar la libreria para subir imagenes
    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver; 

    autenticado();

    //Base de datos
    $db = conectarDB();

    //Obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $vendedores = mysqli_query($db, $consulta);

    //Inicializar variables como Strings vacíos
    $nombre = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $id_vendedor = '';
    
    //Ejecutar el código después de que el usuario envía el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        /* Crear una nueva instancia de la clase Propiedad */
        $propiedad = new Propiedad($_POST);

        /* Subir imagen */

        //Si no existe la carpeta entonces se crea
        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }
        
        //Generar un nombre único para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . strrchr($_FILES['imagen']['name'], '.');

        /* Asignar la imagen a la propiedad */
        if($_FILES['imagen']['tmp_name']){
            //Crear una instancia de la clase Image
            $manager = new Image(Driver::class);
            //Redimensionar la imagen
            $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800,600);  
            //Asignar el nombre de la imagen a la propiedad
            $propiedad->setImagen($nombreImagen);
        }

        //Validar
        $errores = $propiedad->validar();
        
        //Si no hay errores entonces se procede a insertar en la base de datos
        if(empty($errores)){
            
            //Guardar la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            //Insertar en la base de datos
            $resultado = $propiedad->guardar();

            if($resultado){
                header('Location: /admin?resultado=1');
            }
        }   
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion"> 
        <h1 class="titulo-index">Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form action="/admin/propiedades/crear.php" method="POST" class="formulario margen-superior" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre de la propiedad" value="<?php echo $nombre?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 2" min="1" max="9" value="<?php echo $wc?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 2" min="1" max="9" value="<?php echo $estacionamiento?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="id_vendedor">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($vendedores)): ?>
                        <option <?php echo $vendedor['id_vendedor'] === $id_vendedor ? 'selected' : ''; ?> value="<?php echo $vendedor['id_vendedor']?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>
