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
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $id_vendedor = $_POST['vendedor'];
        $creado = date('Y/m/d');

        //Errores
        $tiposErrores = [
            'nombre' => 'Debes añadir un nombre',
            'precio' => 'Debes añadir un precio',
            'descripcion' => 'La descripción es obligatoria',
            'habitaciones' => 'Debes añadir el número de habitaciones',
            'wc' => 'Debes añadir el número de baños',
            'estacionamiento' => 'Debes añadir el número de estacionamientos',
            'id_vendedor' => 'Debes elegir un vendedor'
        ];

        //Validar que no haya campos vacíos
        foreach($tiposErrores as $tipo => $error){
            if(!$$tipo){
                $errores[] = $error;
            }
        }

        //Si no hay errores entonces se procede a insertar en la base de datos
        if(empty($errores)){
            //Insertar en la base de datos
            $query = "INSERT INTO propiedades (nombre, precio, descripcion, habitaciones, wc, estacionamiento, creado, id_vendedor) VALUES ('$nombre', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$id_vendedor')";

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

        <form action="/admin/propiedades/crear.php" method="POST" class="formulario margen-superior">
            <fieldset>
                <legend>Información General</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre de la propiedad" value="<?php echo $nombre?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

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
