<div class="sidenavbar" style="padding-top:200px">
<?php foreach($cats as $c): ?>
  <a href="<?=base_url();?>?categ=<?=$c['idcategoria']?>&pag=1"> <?=$c['nombre']?> </a>
<?php endforeach; ?>
</div>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <h2 class="my-4">Pagina principal:
        <strong>Destacados</strong>
      </h2>

      <div class="row">

      <?php foreach($destacados as $dest): ?>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="<?=base_url();?>/assets/images/<?=$dest['imagen']?>" alt="imagen_producto"></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#"><?=$dest['nombre'];?></a>
              </h4>
              <p class="card-text"><?=$dest['descripcion'];?></p>
            </div>
          </div>
        </div>
      <?php endforeach;?>    
      </div>
      <!-- /.row -->

      <!-- Paginación! -->

    </div>