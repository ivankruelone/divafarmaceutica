<section class="grid_12">
<div class="block-border">
    <div class="block-content">
        <h1><?php echo $titulo;?></h1>
        
        
            <table class="table sortable" cellspacing="0" width="100%">
            <caption>Registros: <?php echo count($query); ?></caption>
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Factura</th>
							<th scope="col">Fecha</th>
							<th scope="col">No. Cliente</th>
							<th scope="col">Cliente</th>
							<th scope="col">Total</th>
							<th scope="col">Cancelado</th>
							<th scope="col">Pendiente</th>
							<th scope="col">Condiciones</th>
							<th scope="col">Vencimiento</th>
							<th scope="col">Dias</th>
							<th scope="col">Funciones</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    
                    $total = 0;
                    $cancelado = 0;
                    
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

                        $image3 = array(
                                  'src' => base_url().'images/icons/fugue/hp_printer.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                        $image4 = array(
                                  'src' => base_url().'images/icons/fugue/flag.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                        $image5 = array(
                                  'src' => base_url().'images/icons/fugue/flag_gris.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image6 = array(
                                  'src' => base_url().'images/icons/fugue/cross-circle.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image7 = array(
                                  'src' => base_url().'images/icons/fugue/arrow-curve-090.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image8 = array(
                                  'src' => base_url().'images/icons/finefiles/32/excel.png',
                                  'width' => '16',
                                  'height' => '16',
                        );

                        $image9 = array(
                                  'src' => base_url().'images/icons/fugue/flag_blue.png',
                                  'width' => '16',
                                  'height' => '16',
                        );
                        
                        if($row->dias < 0 )
                        {
                            $color = " color: red;";
                        }else{
                            $color = null;
                        }

                        
                    ?>
						<tr>
							<td style="text-align: right;"><?php echo $row->id;?></td>
							<td style="text-align: left;"><?php echo $row->factura;?></td>
							<td style="text-align: center;"><?php echo $row->fecha;?></td>
							<td><?php echo $row->numsuc;?></td>
							<td><?php echo $row->sucursal;?></td>
							<td style="text-align: right;"><?php echo number_format($row->total, 2);?></td>
							<td style="text-align: right;"><?php echo number_format($row->cancelado, 2);?></td>
							<td style="text-align: right;"><?php echo number_format($row->total - $row->cancelado, 2);?></td>
							<td style="text-align: right;"><?php echo $row->condiciones;?></td>
							<td style="text-align: center;"><?php echo $row->vencimiento;?></td>
							<td style="text-align: right;<?php echo $color; ?>"><?php echo $row->dias;?></td>
							<td class="table-actions" style="text-align: center;">
                                <?php 
                                        echo anchor('cuentas/asignar_factura_pedido/'.$row->id, img($image7), array('title' => 'Asignar numero de factura', 'class' => 'with-tip'));
                                        echo anchor('cuentas/cobrar_parcialidad/'.$row->id, img($image2), array('title' => 'Ingresar parcialidad', 'class' => 'with-tip'));
                                        echo anchor('cuentas/detalle_parcialidades/'.$row->id, img($image1), array('class' => 'elige', 'tittle' => "Id pedido: ".$row->id.", CLIENTE: ".$row->sucursal));
                                ?>
							</td>
						</tr>
                    <?php
                    
                    $total = $total + $row->total;
                    $cancelado = $cancelado + $row->cancelado;
                    
                    }
                    ?>
					</tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align: right;">Total</td>
                            <td style="text-align: right;"><?php echo number_format($total, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($cancelado, 2); ?></td>
                            <td style="text-align: right;"><?php echo number_format($total - $cancelado, 2); ?></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                    </tfoot>
            </table>
            
            <div id="dialog" title="Basic dialog">
        
    </div>
</div>
</section>