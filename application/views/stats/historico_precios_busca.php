<script type="text/javascript">
$(function() {
	$.getJSON('<?php echo site_url();?>/stats/get_json_precio_historico/<?php echo $producto->clave; ?>', function(data) {

		// Create the chart
		window.chart = new Highcharts.StockChart({
			chart : {
				renderTo : 'container'
			},

			rangeSelector : {
				selected : 1
			},

			title : {
				text : 'Precio Historico: <?php echo $producto->descripcion."<br />Proveedor: ".$producto->razon;?>'
			},

			yAxis : {
				title : {
					text : 'Precio'
				},
				plotLines : [{
					value : <?php echo $producto->maximo; ?>,
					color : 'green',
					dashStyle : 'shortdash',
					width : 2,
					label : {
						text : 'Maximo $ <?php echo number_format($producto->maximo, 2); ?>',
                        align : 'right'
					}
				}, {
					value : <?php echo $producto->minimo; ?>,
					color : 'red',
					dashStyle : 'shortdash',
					width : 2,
					label : {
						text : 'Minimo $ <?php echo number_format($producto->minimo, 2); ?>',
                        align : 'right'
					}
				}, {
					value : <?php echo $producto->promedio; ?>,
					color : 'blue',
					dashStyle : 'shortdash',
					width : 2,
					label : {
						text : 'Promedio $ <?php echo number_format($producto->promedio, 2); ?>',
                        align : 'right'
					}
				}]
			},

			series : [{
				name : 'Precio',
				data : data,
                id : 'dataseries',
				tooltip : {
					valueDecimals : 2
				},
			}]
		});
        
        Highcharts.setOptions({
        	global: {
        		useUTC: false
        	}
        });
	});
});

		</script>
        <script src="<?php echo base_url();?>js/highstock/highstock.js"></script>
        <script src="<?php echo base_url();?>js/highstock/modules/exporting.js"></script>
            <div id="container" style="height: 500px; min-width: 500px"></div>
            <p>
            
            <h2 align="center">Kardex: <?php echo count($query); ?></h2>
            
            <table class="table" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th scope="col"># Proveedor</th>
							<th scope="col">Proveedor</th>
							<th scope="col">Descripci&oacute;n</th>
							<th scope="col">Precio</th>
							<th scope="col">Fecha</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    foreach($query as $row){
                            
                    ?>
						<tr>
							<td align="right"><?php echo $row->id;?></td>
							<td><?php echo $row->razon;?></td>
							<td><?php echo $row->descripcion;?></td>
							<td><?php echo $row->precio;?></td>
							<td><?php echo $row->fec_doc;?></td>
						</tr>
                    <?php
                    
                    }
                    ?>
					</tbody>
            </table>
            
            </p>
