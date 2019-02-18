    <!-- Page Content -->
<div class="container">
<form method="post">
    <div class="row">
<?php foreach($product as $prod):?>
    <div class="col-lg-12 col-sm-12 portfolio-item">
          <div class="card h-100" style="padding-top:30px">
          <img class="card-img-top" src="<?=base_url();?>/assets/images/<?=$prod['imagen']?>" alt="imagen_producto"
          style="height:600px;width:500px;"></a>
            <div class="card-body">
              <h4 class="card-title">
                <p name="name" value="<?=$prod['nombre']?>"><?=$prod['nombre']?></p>
                <?php $precio=$prod['precio'] + ($prod['precio'] * $prod['iva']/100)?>
                <input type="text" name="precio" placeholder="<?=$precio?>" value="<?=$precio?>" readonly> € (IVA incluido)</i>
              </h4>
              <p class="card-text" name="descrip"><?=$prod['descripcion'];?></p>
              Cantidad: <input type="text" name="cant"><br/>
              <a href="<?=site_url('mycart/add/'.$this->input->get('prod'))?>">Añadir al carrito</a>
            </div>
        </div>
    </div>
<?php  endforeach;?>
    
    
</div>
</form>
</div>