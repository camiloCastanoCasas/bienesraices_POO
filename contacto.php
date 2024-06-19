<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion"> 
        <h1 class="titulo-index">Complete el formulario de Contacto</h1>

        <form action="" method="POST" class="formulario">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" placeholder="Tu nombre" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" placeholder="Tu correo electrónico" required>

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" placeholder="Tu teléfono" required>

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la Propiedad</legend>
                <label for="opciones">Vende o Compra:</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto:</label>
                <input type="number" id="presupuesto" placeholder="Tu Precio o Presupuesto" required>
            </fieldset>
            
            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado:</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" name="contacto" id="contactar-telefono" value="telefono">

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" name="contacto" id="contactar-email" value="email" checked>
                </div>

                <p>Si eligió teléfono, elija la fecha y la hora:</p>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">

                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" class="boton-verde" value="Enviar">
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>