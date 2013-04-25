<table class="table">
<caption>Registros encontrados: <?php echo $query->num_rows();?></caption>
    <thead>
        <tr>
            <th>Folio</th>
            <th>Unidad</th>
            <th>Requeridos</th>
            <th>Surtidos</th>
            <th>Negados</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $req = 0;
        $sur = 0;
        $neg = 0;
        foreach($query->result() as $row){
        
        ?>
        <tr>
            <td><?php echo $row->id; ?></td>
            <td><?php echo $row->sucursal; ?></td>
            <td align="right"><?php echo number_format($row->canreq, 0); ?></td>
            <td align="right"><?php echo number_format($row->cansur, 0); ?></td>
            <td align="right"><?php echo number_format($row->negados, 0); ?></td>
        </tr>
        <?php
        
            $req = $req + $row->canreq;
            $sur = $sur + $row->cansur;
            $neg = $neg + $row->negados;
        
        }
        
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" style="text-align: right;">Tototales</td>
            <td align="right"><?php echo number_format($req, 0); ?></td>
            <td align="right"><?php echo number_format($sur, 0); ?></td>
            <td align="right"><?php echo number_format($neg, 0); ?></td>
        </tr>
    </tfoot>
</table>
