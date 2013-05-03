<section class="grid_6">
    <div class="block-border">


        <div class="block-content" id="formato">
            <h1>
                <?php echo $titulo;?>
            </h1>
            <?php echo form_open('pedidos/submit_editar_empleado', array('class' => 'form', 'id' => 'nuevo_empleado_form'));?>
            <fieldset>
            <legend>Modifica los valores y da click en Guardar</legend>
            

            <p>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="full-width" required="required" autofocus="autofocus" value="<?php echo $row->nombre; ?>" />
            </p>

            <?php
            
            $iva = array(
                0 => 'NO',
                1 => 'SI'
                );

            ?>

            <p>
                <label for="activo">El empleado esta activo</label>
                <?php echo form_dropdown('activo', $iva, $row->activo, 'id="activo"');?>
            </p>

            <p>
                <button class="big" type="submit">Guardar Cambios</button>
            </p>

            </fieldset>

            <?php 
            
            echo form_hidden('num_emp', $row->num_emp);
            echo form_close();
            
            ?>
            
        </div>
        
    </div>
</section>
