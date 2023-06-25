<main class="contenedor seccion">
        <h1>Actualizar propiedad</h1>
        <a href="/admin" class="boton boton-verde"> Volver</a>

        <?php
        if($errores){
        foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; }?>

        <form action="" class="formulario" method="POST" enctype="multipart/form-data">
        
            <?php include 'formulario.php'; ?>

            <input type="submit" class="boton boton-verde" value="Actualizar Propiedad">
        </form>
    </main>