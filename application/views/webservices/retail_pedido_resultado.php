<?php
?>
<h2 align="center"><?php echo $xml->attributes()->sucursal." - ".$xml->attributes()->nombre;?></h2>
<h2 align="center">Periodo: <?php echo $xml->attributes()->perini." al ".$xml->attributes()->perfin;?></h2>
<p align="center"><?php echo anchor('webservices/previo_pedido_retail', 'Generar un previo de pedido con los datos actuales.');?></p>
<table class="table sortable">
    <thead>
        <tr>
            <th>Clave</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Inventario</th>
            <th>Buffer</th>
            <th>Flag</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        $inv = 0;
        $buffer = 0;
        
        $a = '<?xml version="1.0" encoding="UTF-8"?>';
        $a.="<pedido sucursal=\"".$xml->attributes()->sucursal."\" nombre=\"".$xml->attributes()->nombre."\" perini=\"".$xml->attributes()->perini."\" perfin=\"".$xml->attributes()->perfin."\">";
        
        foreach($xml->producto as $row){
            
            $color = null;
            
            
            if( (int)$row->inv > (int)$row->buffer){
                $color = 'style="background-color: #9ACD32;"';
            }elseif((int)$row->inv < (int)$row->buffer){
                $color = 'style="background-color: #CD5C5C;"';
                
                $a.="<linea><clave>".$row->clave."</clave><cantidad>".((double)$row->buffer - (double)$row->inv)."</cantidad></linea>";

            }
        
            
            
        ?>
        <tr>
            <td><?php echo $row->clave; ?></td>
            <td><?php echo $row->descripcion; ?></td>
            <td><?php echo $row->pres; ?></td>
            <td align="right"><?php echo number_format((double)$row->inv, 0); ?></td>
            <td align="right"><?php echo number_format((double)$row->buffer, 0); ?></td>
            <td <?php echo $color; ?>>&nbsp;</td>
        </tr>
        <?php
        
        $inv = $inv + (double)$row->inv;
        $buffer = $buffer + (double)$row->buffer;
        
        }
        
        $a.="</pedido>";
        
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td align="right" colspan="3">Total</td>
            <td align="right"><?php echo number_format($inv, 0); ?></td>
            <td align="right"><?php echo number_format($buffer, 0); ?></td>
            <td>&nbsp;</td>
        </tr>
    </tfoot>
</table>

<?php

    $this->session->set_flashdata('pedido', $a);
?>

<script language="javascript" type="text/javascript">
$.fn.dataTableExt.oStdClasses.sWrapper = 'no-margin last-child';
$.fn.dataTableExt.oStdClasses.sInfo = 'message no-margin';
$.fn.dataTableExt.oStdClasses.sLength = 'float-left';
$.fn.dataTableExt.oStdClasses.sFilter = 'float-right';
$.fn.dataTableExt.oStdClasses.sPaging = 'sub-hover paging_';
$.fn.dataTableExt.oStdClasses.sPagePrevEnabled = 'control-prev';
$.fn.dataTableExt.oStdClasses.sPagePrevDisabled = 'control-prev disabled';
$.fn.dataTableExt.oStdClasses.sPageNextEnabled = 'control-next';
$.fn.dataTableExt.oStdClasses.sPageNextDisabled = 'control-next disabled';
$.fn.dataTableExt.oStdClasses.sPageFirst = 'control-first';
$.fn.dataTableExt.oStdClasses.sPagePrevious = 'control-prev';
$.fn.dataTableExt.oStdClasses.sPageNext = 'control-next';
$.fn.dataTableExt.oStdClasses.sPageLast = 'control-last';
 
/*
 * Apply the plugin to every table with the class 'sortable'
 */
$(document).ready(function()
{
    $('.sortable').each(function(i)
    {
        // DataTable config
        var table = $(this),
            oTable = table.dataTable({
                oLanguage: {
			sLengthMenu: "Mostrando _MENU_ registros por pagina",
			sZeroRecords: "No hay Registros - lo siento",
			sInfo: "Mostrando _START_ hasta _END_ de _TOTAL_ registros",
			sInfoEmpty: "Mostrando 0 hasta 0 de 0 registros",
			sInfoFiltered: "(filtrando de _MAX_ registros en total)",
            sSearch: "Buscar:"
		},
        aaSorting: [[ 1, "asc" ]],
                
                /*
                 * Set DOM structure for table controls
                 * @url http://www.datatables.net/examples/basic_init/dom.html
                 */
                sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',
                 
                /*
                 * Callback to apply template setup
                 */
                fnDrawCallback: function()
                {
                    this.parent().applyTemplateSetup();
                },
                fnInitComplete: function()
                {
                    this.parent().applyTemplateSetup();
                }
            });
         
        // Sorting arrows behaviour
        table.find('thead .sort-up').click(function(event)
        {
            // Stop link behaviour
            event.preventDefault();
             
            // Find column index
            var column = $(this).closest('th'),
                columnIndex = column.parent().children().index(column.get(0));
             
            // Send command
            oTable.fnSort([[columnIndex, 'asc']]);
             
            // Prevent bubbling
            return false;
        });
        table.find('thead .sort-down').click(function(event)
        {
            // Stop link behaviour
            event.preventDefault();
             
            // Find column index
            var column = $(this).closest('th'),
                columnIndex = column.parent().children().index(column.get(0));
             
            // Send command
            oTable.fnSort([[columnIndex, 'desc']]);
             
            // Prevent bubbling
            return false;
        });
    });
});
            </script>
