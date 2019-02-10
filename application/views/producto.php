    <!-- Page Content -->
<div class="container">
<form method="post">
    <div class="row">
<?php foreach($product as $prod):?>
    <div class="col-lg-12 col-sm-12 portfolio-item">
          <div class="card h-100">
          <img class="card-img-top" src="<?=base_url();?>/assets/images/<?=$prod['imagen']?>" alt="imagen_producto"
          style="height:600px;width:500px;"></a>
            <div class="card-body">
              <h4 class="card-title">
                <p><?=$prod['nombre'];?></p>
              </h4>
              <p class="card-text"><?=$prod['descripcion'];?></p><a href="">Añadir al carrito</a>
            </div>
        </div>
    </div>
<?php  endforeach;?>
    
    
</div>
</form>
</div>