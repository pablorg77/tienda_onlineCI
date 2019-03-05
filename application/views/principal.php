    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <h3 class="my-4">Pagina principal:
        <a href="<?=base_url()?>"><strong>Destacados</strong></a> | 
        <a href="<?=site_url('Destacados/getArticulos/1')?>"><strong>Más artículos</strong></a>
      </h3>

      <div class="row">

      <?php foreach($articulos as $art): ?>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="<?=site_url('producto')?>?prod=<?=$art['idproducto']?>">
            <img class="card-img-top" src="<?=base_url();?>/assets/images/<?=$art['imagen']?>" alt="imagen_producto"></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="<?=site_url('producto')?>"><?=$art['nombre'];?></a> : </br>
                <i><?=round(currency_Importe($art['precio'] + ($art['precio'] * $art['iva']/100)),2)?> <?=currency_SimboloMoneda()?></i>
              </h4>
              <p class="card-text"><?=$art['descripcion'];?></p>
            </div>
          </div>
        </div>
      <?php endforeach;?>    
      
      </div>
      <!-- /.row -->

      <!-- Paginación! -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
      <?= $this->pagination->create_links(); ?>
        </li>
      </ul>

    </div>