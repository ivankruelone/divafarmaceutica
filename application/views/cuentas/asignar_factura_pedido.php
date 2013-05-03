<section class="grid_12">
<div class="block-border">
    <div class="block-content">
        <h1><?php echo $titulo;?></h1>
        
        <?php echo form_open('cuentas/submit_asignar_factura_pedido', array('class' => 'form', 'id' => 'formato')); ?>
        <fieldset>
            <legend>Ingresa los valores y da click en Guardar</legend>

            <p>
                <label for="cuenta">Id pedido</label>
                <input type="number" name="cuenta" id="cuenta" required="required" value="<?php echo $cuenta; ?>" disabled="disabled" />
            </p>

            <p>
                <label for="factura"># de factura</label>
                <input type="text" name="factura" id="factura" required="required" />
            </p>

            <p>
            
                <button class="big" type="submit">Guardar Cambios</button>
            
            </p>

        </fieldset>

        <?php 
        
        echo form_hidden('id', $cuenta);
        
        echo form_close(); 
        
        ?>
    </div>
</div>
</section>