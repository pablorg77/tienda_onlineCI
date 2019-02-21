<div class="container">

      <div class="row">
        
            <table cellpadding="6" cellspacing="1" style="width:80%" border="1">

                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acción</th>
                </tr>

                <?php foreach ($this->cart->contents() as $items): ?>

                <tr>
                    <td><img class="card-img-top" id="imagen" src=<?=base_url('assets/images/'.$items['img'])?> style="width:40px;height:40px">
                    <?= $items['name'];?></td>
                    <td><?= $items['price'];?></td>
                    <td><?= $items['qty'];?></td>
                    <td><a href=<?=site_url('mycart/delete/'.$items['rowid'])?>>Borrar</a></td>
                </tr>

                <?php endforeach; ?>


                <tr>
                    <td colspan="2"> </td>
                    <td class="right"><strong>Total</strong></td>
                    <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                </tr>
                
            </table>
            
      </div>

    </div>