<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tienda online">
    <meta name="author" content="Pablo Rodriguez Gonzalez">

    <title>Tienda online</title>

    <link href="<?=base_url();?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>/assets/css/mystyle.css" rel="stylesheet">

</head>
<body>

<div class="sidenavbar">
<?php foreach($cats as $c): ?>
  <a href="<?=base_url();?>?categ=<?=$c['idcategoria']?>&pag=1"> <?=$c['nombre']?> </a>
<?php endforeach; ?>
</div>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Tienda online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../tienda_onlineCI">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <h1 class="my-4">Pagina principal
        <small>Destacados</small>
      </h1>

      <div class="row">

      <?php foreach($destac as $dest): ?>
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

      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Tienda online 2019</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?=base_url();?>/assets/jquery/jquery.min.js"></script>
    <script src="<?=base_url();?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>
