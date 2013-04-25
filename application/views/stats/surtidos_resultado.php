<link rel="stylesheet" href="<?php echo base_url();?>css/themes/base/jquery.ui.all.css" />
<script src="<?php echo base_url();?>js/ui/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.dialog.min.js"></script>
<table class="table">
<caption>Registros encontrados: <?php echo $query->num_rows();?></caption>
    <thead>
        <tr>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Negados</th>
            <th>Inventario</th>
            <th>Requeridos</th>
            <th>Surtidos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        foreach($query->result() as $row){
        
        ?>
        <tr>
            <td><?php echo $row->clave; ?></td>
            <td><?php echo $row->descripcion; ?></td>
            <td><?php echo $row->unidad; ?></td>
            <td align="right"><?php echo $row->negados; ?></td>
            <td align="right"><?php echo $row->inv; ?></td>
            <td align="right"><?php echo anchor('stats/detalle_surtidos/'.$row->clave.'/'.$perini.'/'.$perfin, number_format($row->canreq, 0), array('class' => 'elige', 'tittle' => $row->descripcion." CLAVE: ".$row->clave)) ?></td>
            <td align="right"><?php echo anchor('stats/detalle_surtidos/'.$row->clave.'/'.$perini.'/'.$perfin, number_format($row->cansur, 0), array('class' => 'elige', 'tittle' => $row->descripcion." CLAVE: ".$row->clave)) ?></td>
        </tr>
        <?php
        
        }
        
        ?>
    </tbody>
</table>
<div id="dialog" title="Basic dialog">
</div>
<script type="text/javascript">
$('.elige').click(function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    var titulo = $(this).attr('tittle');
    
    $( "#dialog" ).dialog({
        modal: true,
        open: function () {
            $(this).load(url);           
        },
        title: titulo,
        width: 600,
        height: 400
    });
    
});
//$(function() {
//$( "#dialog" ).dialog();
//});
</script>