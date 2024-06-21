<?php 
    //Autenticar el usuario
    require 'includes/config/database.php';
    $db = conectarDB();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = "El correo electrónico es obligatorio o no es válido";
        }

        if(!$password){
            $errores[] = "La contraseña es obligatoria";
        }

        if(empty($errores)){
            //Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows){
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if($auth){
                    //El usuario está autenticado
                    session_start();

                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');
                } else {
                    $errores[] = "La contraseña es incorrecta";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion"> 
        <h1 class="titulo-index">Iniciar Sesión</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form method="POST" class="formulario formulario-inicio-sesion">
            <label for="email">Correo electrónico</label>
            <input type="email" placeholder="Tu correo electrónico" id="email" name="email">

            <label for="password">Contraseña</label>
            <input type="password" placeholder="Tu contraseña" id="password" name="password">

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>