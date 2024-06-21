<?php 

    require '../../includes/funciones.php';
    $auth = autenticado();

    //Revisar si el usuario está autenticado
    if(!$auth){
        header('Location: /');
    }

    //Obtener el ID de la URL
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); //Validar que sea un entero

    if(!$id){
        header('Location: /admin'); //Redireccionar si no hay ID
    }

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $vendedores = mysqli_query($db, $consulta);

    //Consultar la propiedad
    $consultaPropiedad = "SELECT * FROM propiedades WHERE id_propiedad = $id";
    $propiedad = mysqli_query($db, $consultaPropiedad);
    $propiedad = mysqli_fetch_assoc($propiedad);

    //Arreglo con mensajes de errores
    $errores = [];

    //Inicializar variables como Strings vacíos
    $nombre = $propiedad['nombre'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $id_vendedor = $propiedad['id_vendedor'];
    $imagen = $propiedad['imagen'];
    
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

        //Validar tamaño de la imagen
        if($imagen['size'] > 1000 * 2000){
            $errores[] = 'La imagen es muy pesada';
        }

        //Si no hay errores entonces se procede a insertar en la base de datos
        if(empty($errores)){

            //Crear carpeta
            $carpeta = '../../imagenes/';

            if(!is_dir($carpeta)){
                mkdir($carpeta);
            }

            $nombreImagen = '';

            if($imagen['name']){
                //Eliminar imagen previa
                unlink($carpeta . $propiedad['imagen']); 

                //Generar un nombre único
                $nombreImagen = md5(uniqid(rand(), true)) . strrchr($imagen['name'], '.');

                //Mover imagen a la carpeta
                move_uploaded_file($imagen['tmp_name'], $carpeta . $nombreImagen);

            }else{
                $nombreImagen = $propiedad['imagen'];
            }

            //Insertar en la base de datos
            $query = "UPDATE propiedades SET nombre = '$nombre', precio = '$precio', imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, id_vendedor = $id_vendedor, imagen = '$nombreImagen' WHERE id_propiedad = $id";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('Location: /admin?resultado=2');
            }
        }   
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion"> 
        <h1 class="titulo-index">Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario margen-superior" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre de la propiedad" value="<?php echo $nombre?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagen?>" alt="" class="imagen-small">

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

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>
