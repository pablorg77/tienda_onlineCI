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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Tienda online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url();?>">Página Principal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('login');?>">Iniciar sesión</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('registro');?>">Registrarse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Carrito</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>