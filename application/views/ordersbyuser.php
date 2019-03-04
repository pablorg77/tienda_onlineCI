<div class="container">

      <div class="row">
        
            <table cellpadding="6" cellspacing="1" style="width:90%" border="1" >

                <tr>
                    <th>Estado</th>
                    <th>Direccion de envío</th>
                    <th>Fecha de creación</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>

                <?php foreach($orders as $order): ?>

                    <?php 
                        if($order['estado']=='P')
                            $estado='Pendiente de envío';
                        if($order['estado']=='E')
                            $estado='En envío';
                        if($order['estado']=='T')
                            $estado='Transacción completa';
                    ?>
                
                    <tr>
                        <td><?=$estado?></td>                
                        <td><?=$order['direccion']?></td>
                        <td><?=$order['fechaCreacion']?></td>
                        <td><?=$order['total']?></td>
                        <td><a href="<?=site_url('TransformToPDF/orderToPDF')?>">Convertir a PDF</a> | 
                        <a href="<?=site_url('')?>">Borrar</a></td>
                    </tr>  
                <?php endforeach;?>  
            </table>    
      </div>
</div>