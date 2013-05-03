<section class="grid_6">
    <div class="block-border">


        <div class="block-content" id="formato">
            <h1>
                <?php echo $titulo;?>
            </h1>
            <?php echo form_open('pedidos/submit_nuevo_empleado', array('class' => 'form', 'id' => 'nuevo_empleado_form'));?>
            <fieldset>
            <legend>Modifica los valores y da click en Guardar</legend>
            

            <p>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="full-width" required="required" autofocus="autofocus" />
            </p>


            <p>
                <button class="big" type="submit">Guardar Cambios</button>
            </p>

            </fieldset>

            <?php 
            
            echo form_close();
            
            ?>
            
        </div>
        
    </div>
</section>
