<div class="contenedor-anuncios">
        <?php foreach($propiedades as $propiedad): ?>
            
            <div class="anuncio">
                    <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen anuncio">
                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad->titulo; ?></h3>
                    <p><?php echo $propiedad->descripcion; ?>
                    </p>
                    <p class="precio">$<?php echo $propiedad->precio; ?></p>
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img loading="lazy" class="icono" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad->wc; ?></p>
                        </li>
                        <li>
                            <img loading="lazy" class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $propiedad->estacionamientos; ?></p>
                        </li>
                        <li>
                            <img loading="lazy" class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p><?php echo $propiedad->habitaciones; ?></p>
                        </li>
                    </ul>

                    <a class="boton boton-amarillo-block" href="propiedad?id=<?php echo $propiedad->id;?>">Ver Propiedad</a>
                </div>
            </div> <!-- Termina anuncio -->
            <?php endforeach; ?>
            
</div> <!--Termina contenedor-anuncios-->