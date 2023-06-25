<?php
?>
<fieldset>
                <legend>Informacion general:</legend>

                <label for="titulo">Titulo:</label>
                <input name="propiedad[titulo]" type="text" id="titulo" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">
                
                <label for="Precio">Precio:</label>
                <input name="propiedad[precio]" max="99999999" type="number" id="Precio" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">
                
                <label for="Imagen">Imagen:</label>
                <input type="file" id="Imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
                <?php if($propiedad->imagen) { ?>

                    <img src="/imagenes/<?php echo $propiedad->imagen;?>" class="imagen-small" alt="imagen propiedad">
                <?php } ?>
                
                <label for="descripcion">Descripción::</label>
                <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion de la Propiedad:</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]"  value="<?php echo s($propiedad->habitaciones); ?>" placeholder="Ej: 3" min="1" max="9">
                
                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="propiedad[wc]" value="<?php echo s($propiedad->wc); ?>" placeholder="Ej: 3" min="1" max="9">
                
                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="propiedad[estacionamientos]" value="<?php echo s($propiedad->estacionamientos); ?>" placeholder="Ej: 3" min="1" max="9">
                
            </fieldset>
            <fieldset>
                <legend>Vendedor:</legend>

                <select name="propiedad[vendedores_id]" id="">
                    <option value="" selected disabled>-- Seleccione un vendedor --</option>
                    <?php 
                            $vendedorId=$propiedad->vendedores_id;
                            foreach($vendedores as $vendedor): ?>
                        <option <?php echo $vendedorId===$vendedor->id ? 'selected' : ''; ?> 
                    value="<?php echo $vendedor->id; ?>">
                    <?php echo $vendedor->nombre. " " . $vendedor->apellido;?>
                </option>
                    <?php endforeach; ?>
                </select>
            </fieldset>