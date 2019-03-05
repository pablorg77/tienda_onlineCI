<div class="container">

      <div class="row">
      <?php 
        $ci=get_instance();
        $ci->load->model('Loginuser');
        if($ci->Loginuser->isLogged())
            $userLogged=$ci->Loginuser->getDataFromLoggedUser();
        ?>
        
            <table cellpadding="6" cellspacing="1" style="width:90%" border="1">
            
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>

                <?php foreach ($this->cart->contents() as $items): ?>
                <?php if($ci->Loginuser->isLogged()){
                    if($items['idusuario']==$userLogged->idusuario){?>

                    <tr>
                        <td><?= $items['name'];?></td>
                        <td><?= currency_Importe($items['price'])?></td>
                        <td><?= $items['qty'];?></td>
                    </tr>

                    <?php 
                    }}else{?>
                    <tr>
                        <td><?= $items['name'];?></td>
                        <td><?= currency_Importe($items['price'])?></td>
                        <td><?= $items['qty'];?></td>
                    </tr>

                    <?php }
                    endforeach; 
                    ?>
                

                          
                <tr>
                    <td colspan="0"> </td>
                    <?php if($this->Loginuser->isLogged()){
                    if($items['idusuario']==$userLogged->idusuario){?>
                    <td class="right"><strong>Total</strong></td>
                    <td class="right"><?=currency_SimboloMoneda()?> 
                    <?= currency_Importe($this->cart->format_number($this->cart->total())); ?></td>
                    <?php }}else{?>
                    <td class="right"><strong>Total</strong></td>
                    <td class="right"><?=currency_SimboloMoneda()?> 
                    <?php }?>
                    <?= currency_Importe($this->cart->format_number($this->cart->total())); ?></td>
                                 
                </tr>
                
            </table><br/><br/>
            <?php if($ci->Loginuser->isLogged()):?>
            <p> · Información de contacto: </p>
            <p>- Nombre:<?=$userLogged->nombre?>, <?=$userLogged->apellidos?></p>
            <p>- Correo:<?=$userLogged->correo?></p>
            <p>- DNI:<?=$userLogged->dni?></p>
            <?php endif;?>

      </div>

    </div>