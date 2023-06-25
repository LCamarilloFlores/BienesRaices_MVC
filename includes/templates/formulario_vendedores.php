<?php
?>
<fieldset>
                <legend>Informacion general:</legend>

                <label for="nombre">Nombre:</label>
                <input name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre Del Vendedor" value="<?php echo s($vendedor->nombre); ?>">
                
                <label for="apellido">Apellido:</label>
                <input name="vendedor[apellido]" type="text" id="apellido" placeholder="Apellido Del Vendedor" value="<?php echo s($vendedor->apellido); ?>">
                
                <label for="telefono">Teléfono:</label>
                <input name="vendedor[telefono]" type="cel" id="telefono"
                 placeholder="Teléfono" value="<?php echo s($vendedor->telefono); ?>">
                
</fieldset>