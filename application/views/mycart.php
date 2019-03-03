<div class="container">

      <div class="row">

      <?php 
        $ci=get_instance();
        $ci->load->model('Loginuser');
        $userLogged=$this->Loginuser->getDataFromLoggedUser();
        ?>
        
            <table cellpadding="6" cellspacing="1" style="width:90%" border="1">

                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acción</th>
                </tr>

                <?php foreach ($this->cart->contents() as $items): ?>
                <?php
                    if($items['idusuario']==$userLogged->idusuario){?>

                    <tr>
                        <td><img class="card-img-top" id="imagen" src=<?=base_url('assets/images/'.$items['img'])?> style="width:40px;height:40px">
                        <?= $items['name'];?></td>
                        <td><?= $items['price'];?></td>
                        <td><?= $items['qty'];?></td>
                        <td><a href=<?=site_url('mycart/delete/'.$items['rowid'])?>>Borrar</a></td>
                    </tr>

                    <?php 
                    }else{}
                    endforeach; 
                    ?>

                
            
                <tr>
                    <td colspan="0"> </td>
                    <?php if(isset($items)):
                    if($items['idusuario']==$userLogged->idusuario):?>
                    <td class="right"><strong>Total</strong></td>
                    <td class="right">€ <?php echo $this->cart->format_number($this->cart->total()); ?></td>
                    <?php endif;?>
                    <?php endif;?> 
                    <td><a href="<?=site_url('mycart/acceptBuy')?>"> Tramitar pedido </a> | 
                    <a href="<?=site_url('TransformToPDF')?>">Convertir a PDF</a> | 
                    <a href="<?=site_url('mycart/deleteAll')?>">Borrar todo</a></td>
                    
                    
                </tr>
                
            </table>
            
      </div>

    </div>