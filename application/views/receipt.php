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
                </tr>

                <?php foreach ($this->cart->contents() as $items): ?>
                <?php
                    if($items['idusuario']==$userLogged->idusuario){?>

                <tr>
                    <td><?= $items['name'];?></td>
                    <td><?= $items['price'];?></td>
                    <td><?= $items['qty'];?></td>
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
                </tr>
                
            </table><br/><br/>
            <p> · Información de contacto: </p>
            <p>- Nombre:<?=$userLogged->nombre?>, <?=$userLogged->apellidos?></p>
            <p>- Correo:<?=$userLogged->correo?></p>
            <p>- DNI:<?=$userLogged->dni?></p>


      </div>

    </div>