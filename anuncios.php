<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion"> 
        <h1 class="titulo-index">Anuncios</h1>
        
        <?php 
            $limite = 10;
            include 'includes/anuncios.php';
        ?>
    </main>

<?php 
    incluirTemplate('footer');
?>
