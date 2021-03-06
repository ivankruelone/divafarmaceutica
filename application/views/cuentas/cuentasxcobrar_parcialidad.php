<section class="grid_12">
<div class="block-border">
    <div class="block-content">
        <h1><?php echo $titulo;?></h1>
        
        <?php echo form_open('cuentas/submit_cobrar_parcialidad', array('class' => 'form', 'id' => 'formato')); ?>
        <fieldset>
            <legend>Ingresa los valores y da click en Guardar</legend>

            <p>
                <label for="cuenta">Id pedido</label>
                <input type="number" name="cuenta" id="cuenta" required="required" value="<?php echo $cuenta; ?>" disabled="disabled" />
            </p>

            <p>
                <label for="monto">Monto (Maximo <?php echo number_format($maximo, 2);?>)</label>
                <input type="number" name="monto" id="monto" required="required" />
            </p>

            <p>
                <label for="fecha">Fecha</label>
                <input type="text" name="fecha" id="fecha" required="required" class="datepicker" />
            </p>

            <p>
                <label for="referencia">Referencia</label>
                <input type="number" name="referencia" id="referencia" required="required" />
            </p>

            <p>
                <label for="forma">Forma de pago</label>
                <input type="number" name="forma" id="forma" required="required" />
            </p>

            <p>
            
                <button class="big" type="submit">Guardar Cambios</button>
            
            </p>

        </fieldset>

        <?php 
        
        echo form_hidden('id', $cuenta);
        echo form_hidden('maximo', $maximo);
        
        echo form_close(); 
        
        ?>
    </div>
</div>
</section>