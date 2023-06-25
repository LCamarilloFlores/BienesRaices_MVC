<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $resultado->titulo; ?></h1>
            <img src="/imagenes/<?php echo $resultado->imagen; ?>" alt="imagen destacada" loading="lazy">
        <div class="resumen-propiedad">
        <p class="precio">$<?php echo $resultado->precio; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img loading="lazy" class="icono" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $resultado->wc; ?>
            </li>
            <li>
                <img loading="lazy" class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $resultado->estacionamientos; ?></p>
            </li>
            <li>
                <img loading="lazy" class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $resultado->habitaciones; ?></p>
            </li>
        </ul>
       
        <p class="descripcion"><?php echo $resultado->descripcion; ?></p>
        </div>
    </main>
