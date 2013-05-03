<section class="grid_12">
<div class="block-border">
    <div class="block-content" id="hoja_captura">
        <div align="center">
            <h1><?php echo $titulo;?>
            
                        <?php
                            $image = array(
                                      'src' => base_url().'images/icons/fugue/plus-circle-blue.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            
                            echo anchor('pedidos/nuevo_empleado', img($image).' nuevo empleado');
                        ?>

            
            </h1>
            <p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Activo</th>
                            <th>Accion</th>
                        </tr>
                        <tbody>
                            <?php 
                            
                            $a = array('1' => 'Activo', '0' => 'Inactivo');
                            $image2 = array(
                                  'src' => base_url().'images/icons/fugue/pencil.png',
                                  'width' => '16',
                                  'height' => '16',
                                  );

                            foreach($query as $row){
                                
                            ?>
                            <tr>
                                <td><?php echo $row->num_emp; ?></td>
                                <td><?php echo $row->nombre; ?></td>
                                <td><?php echo $a[$row->activo]; ?></td>
    							<td class="table-actions" align="center">
                                    <?php echo anchor('pedidos/editar_empleado/'.$row->num_emp, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));?>
    							</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </thead>
                </table>
            </p>
        </div>
    </div>
</div>
</section>
