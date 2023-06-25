<main class="contenedor seccion">
        <?php if($mensaje){ ?>
        <div class="alerta <?php echo $mensaje === "Mensaje enviado correctamente" ? 'exito':'error'; ?>">
        <?php echo $mensaje;?>
        </div>
        <?php }; ?>
        <h1>
            Contacto
        </h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="imagen contacto">
        </picture>

        <h2>Llene el formulario de contacto:</h2>
        <form action="" class="formulario" action='/contacto' method="POST">
            <fieldset>
                <legend>Información Personal.</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required>
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Vende o compra:</label>
                <select name="contacto[accion]" id="opciones" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="comprar">Comprar</option>
                    <option value="vender">Vender</option>
                </select>
                <label for="presupuesto">Precio o presupuesto</label>
                <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[precio]" required>
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado:</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input required name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono">
                    
                    <label for="contactar-email">E-mail</label>
                    <input required name="contacto[contacto]" type="radio" value="email" id="contactar-email">
                </div>

                <div id="contacto"></div>
                
                
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>