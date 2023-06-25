<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" action="/login">
        <fieldset>
                <legend>Ingrese su correo y contraseña.</legend>
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" placeholder="Tu password" id="password" name="password" required>
        </fieldset>
        <input type="submit" class="boton boton-verde" value="Iniciar Sesión">
        </form>
    </main>