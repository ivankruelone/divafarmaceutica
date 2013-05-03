<table class="table" style="width: 100%; font-size: smaller;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Referencia</th>
            <th>Forma de pago</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    
    $monto = 0;
    foreach($query as $row){
        
    ?>
        <tr>
            <td><?php echo $row->id; ?></td>
            <td><?php echo $row->fecha; ?></td>
            <td style="text-align: right;"><?php echo number_format($row->monto, 2); ?></td>
            <td><?php echo $row->referencia; ?></td>
            <td><?php echo $row->forma; ?></td>
        </tr>
    <?php 
    
    $monto = $monto + $row->monto;
    
    }
    
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">Total</td>
            <td style="text-align: right;"><?php echo number_format($monto, 2); ?></td>
            <td colspan="2">&nbsp;</td>
        </tr>
    </tfoot>
</table>