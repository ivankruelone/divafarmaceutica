<article class="container_12">

    <section class="grid_12">
    
        <div class="block-border">
        
        <div class="block-content">
        <h1>Indicadores</h1>
        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
        </div>
    
    </div>

    </section>
 
    <section class="grid_6">
    
        <div class="block-border">
        
        <div class="block-content">
        <h1>Superan limite de credito</h1>
        
            <table class="table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Id.</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Limite</th>
                        <th>Diferencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    $total = 0;
                    $limite = 0;
                    $diferencia = 0;
                    
                    foreach($limites as $row){
                        
                    ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><?php echo $row->sucursal; ?></td>
                        <td style="text-align: right;"><?php echo number_format($row->total, 2); ?></td>
                        <td style="text-align: right;"><?php echo number_format($row->limite, 2); ?></td>
                        <td style="text-align: right;"><?php echo number_format($row->total - $row->limite, 2); ?></td>
                    </tr>
                    <?php 
                    
                    $total = $total + $row->total;
                    $limite = $limite + $row->limite;
                    $diferencia = $diferencia + $row->total - $row->limite;
                    
                    }
                    
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td style="text-align: right;" colspan="2">Totales</td>
                        <td style="text-align: right;"><?php echo number_format($total, 2); ?></td>
                        <td style="text-align: right;"><?php echo number_format($limite, 2); ?></td>
                        <td style="text-align: right;"><?php echo number_format($diferencia, 2); ?></td>
                    </tr>
                </tfoot>
            </table>

        </div>
    
    </div>

    </section>
     
    <section class="grid_6">
    
        <div class="block-border">
        
        <div class="block-content">
        <h1>Indicadores</h1>
        [Column content goes here]
        </div>
    
    </div>

    </section>
     
</article>