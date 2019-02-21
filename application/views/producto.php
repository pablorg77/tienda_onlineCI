    <!-- Page Content -->
<div class="container">
<form method="post" action="<?=site_url('mycart/add/'.$this->input->get('prod'))?>">
    <div class="row">
<?php foreach($product as $prod):?>
    <div class="col-lg-12 col-sm-12 portfolio-item">
          <div class="card h-100" style="padding-top:30px">
          <img class="card-img-top" src="<?=base_url();?>/assets/images/<?=$prod['imagen']?>" alt="imagen_producto"
          style="height:600px;width:500px;"></a>
            <div class="card-body">
              <h4 class="card-title">
                <p name="name" value="<?=$prod['nombre']?>"><?=$prod['nombre']?></p>

                <?= $desc
                /*if($prod['descuento']!=null):?>
                <i><div name="precio"><?=$prod['precio']?> € (IVA incluido)</div></i>
                <?php endif; 
                else{?>
                <i>Ahora<div name="descuento"><?=$prod['descuento']?> € (IVA incluido)</div></i>
                <del><i>Antes<div name="precio"><?=$prod['precio']?> € (IVA incluido)</div></i></del>
                <?php }*/?>
              </h4>
              <p class="card-text" name="descrip"><?=$prod['descripcion'];?></p>
              Cantidad: <input type="text" name="cant"><br/>
              <input type="submit" value="Añadir al carrito"></input>
            </div>
        </div>
    </div>
<?php  endforeach;?>
    
    
</div>
</form>
</div>