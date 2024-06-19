<?php 

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $vendedores = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = [];

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

        // Sanitizar los datos
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $id_vendedor = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');
        $imagen = $_FILES['imagen']; //Asignar files a una variable

        //Errores
        $tiposErrores = [
            'nombre' => 'Debes añadir un nombre',
            'precio' => 'Debes añadir un precio',
            'descripcion' => 'La descripción es obligatoria',
            'habitaciones' => 'Debes añadir el número de habitaciones',
            'wc' => 'Debes añadir el número de baños',
            'estacionamiento' => 'Debes añadir el número de estacionamientos',
            'id_vendedor' => 'Debes elegir un vendedor',
        ];

        //Validar que no haya campos vacíos
        foreach($tiposErrores as $tipo => $error){
            if(!$$tipo){
                $errores[] = $error;
            }
        }

        //Validar la imagen
        //Si no hay imagen
        if(!$imagen['name'] || $imagen['error']){
            $errores[] = 'Debes añadir una imagen';
        }
        //Validar tamaño de la imagen
        if($imagen['size'] > 1000 * 2000){
            $errores[] = 'La imagen es muy pesada';
        }

        //Si no hay errores entonces se procede a insertar en la base de datos
        if(empty($errores)){

            //Subir imagen
            //Crear carpeta
            $carpeta = '../../imagenes/';

            if(!is_dir($carpeta)){
                mkdir($carpeta);
            }
            
            //Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . strrchr($imagen['name'], '.');

            //Mover imagen a la carpeta
            move_uploaded_file($imagen['tmp_name'], $carpeta . $nombreImagen);

            //Insertar en la base de datos
            $query = "INSERT INTO propiedades (nombre, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, id_vendedor) VALUES ('$nombre', '$precio', '$nombreImagen' , '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$id_vendedor')";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /admin');
            }
        }   
    }

    //Funciones
    require '../../includes/funciones.php';
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

                <select name="vendedor">
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
