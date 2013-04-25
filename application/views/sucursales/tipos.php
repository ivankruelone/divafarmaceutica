<section class="grid_12">
    <div class="block-border">


        <div class="block-content">
            <h1>
                        <?php echo $titulo;?>
                        <?php
                            $image = array(
                                      'src' => base_url().'images/icons/fugue/plus-circle-blue.png',
                                      'width' => '16',
                                      'height' => '16',
                            );
                            
                            echo anchor('sucursales/nuevo_tipo/'.$submenu, img($image).' nuevo tipo');
                        ?>
                        
            </h1>
            <p>
            <table class="table sortable" width="50%">
            <caption>Hay un total de <?php echo count($query);?> tipos registrados.</caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Tipo de Sucursal</th>
							<th scope="col">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    foreach($query as $row){
                        $image1 = array(
                                  'src' => base_url().'images/icons/fugue/cards-address.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image2 = array(
                                  'src' => base_url().'images/icons/fugue/pencil.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                        $iva = array(
                            0 => 'NO',
                            1 => 'SI'
                            );  
                    ?>
						<tr>
							<td><?php echo $row->id;?></td>
							<td><?php echo $row->tipo_sucursal;?></td>
							<td class="table-actions" align="center">
                                <?php echo anchor('sucursales/editar_tipo/'.$row->id.'/'.$submenu, img($image2), array('title' => 'Modificar', 'class' => 'with-tip'));?>
							</td>
						</tr>
                    <?php
                    }
                    ?>
					</tbody>
            </table>
            
            </p>
            
        </div>
    </div>
</section>