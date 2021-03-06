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
<?php 
  $ci=get_instance();
  $ci->load->model('Loginuser');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?=base_url();?>">Tienda online</a>
        <?php if ($ci->Loginuser->isLogged())
              $ci->Loginuser->getUsername();?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url();?>">Página Principal</a>
            </li>
            <li class="nav-item">
              <?php if (!$ci->Loginuser->isLogged())
                  echo "<a class='nav-link' href='".site_url('login')."'>Iniciar sesión</a>";?>
            </li>
            <li class="nav-item">
            <?php if (! $ci->Loginuser->isLogged())
              echo "<a class='nav-link' href='".site_url('registro/getForm')."'>Registrarse</a>"?>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=site_url('mycart')?>"><img src="<?=base_url();?>/assets/images/carrito.png" 
              alt="carrito_compra" style="width:30px; height:30px;"></a>
            </li>
            <li>
              <?php if ($ci->Loginuser->isLogged())
                  echo "<a class='nav-link' href='".site_url('login/accOptions')."'>Configuración</a>";?>
            </li>
            <li class="nav-item">
              <?php if ($ci->Loginuser->isLogged())
                  echo "<a class='nav-link' href='".site_url('Login/showOrders')."'>Pedidos</a>"?>
            </li>
            <li class="nav-item">
              <?php if ($ci->Loginuser->isLogged())
                  echo "<a class='nav-link' href='".site_url('login/logout')."'>Cerrar sesión</a>";?>
            </li>
            <li class="nav-item">
              <?php if (!$ci->Loginuser->isLogged())
                  echo "<a class='nav-link' href='".site_url('Login/changePass')."'>Restablecer contraseña</a>";?>
            </li>
            <li>
              <?php if ($ci->Loginuser->isLogged()):
                $admin=$ci->Loginuser->getDataFromLoggedUser();
                if($admin->idusuario=='1')
                  echo "<a class='nav-link' href='".site_url('groceryCRUD/showProducts')."'>CRUD Admin.</a>";
              endif;?>
            </li>
          </ul>
        </div>
      </div>
    </nav>

<!-- Cuerpo modificable -->
<?= $cuerpo ?>



<!-- Footer -->

<?php 
  $cii=get_instance();
  $cii->load->model('MonetaryUnits');
  $units=$cii->MonetaryUnits->getCurrency();
?>
<footer class="py-5 bg-dark">
    <div class="container">
    <form method="post" action="<?=site_url('Destacados/changeCurrency')?>">
    <p class="m-0 text-center text-white">Seleccione moneda: <select name="monetaryUnits" onchange="this.form.submit()">
    <option value=""> --Your currency-- </option>
    <option value="<?= 1 .'/'.'EUR'?>"> EUR </option>
    <?php foreach ($units as $key=>$unit):?>
    <option value='<?=$unit.'/'.$key?>'><?=$key?></option>
    <?php endforeach;?>
    </select></p>
    </form>
    <p class="m-0 text-center text-white">Copyright &copy; Tienda online 2019</p>
    
    <p class="m-0 text-right text-white"><a href="<?=base_url()?>Doc/tree.html">Documentación</a></p>
    <p class="m-0 text-right text-white"><a href="https://github.com/pablorg77/tienda_onlineCI.git">¡Sigue mi trabajo!</a></p>
    </div>
    
</footer>

<!-- Bootstrap core JavaScript -->
<script src="<?=base_url();?>/assets/jquery/jquery.min.js"></script>
<script src="<?=base_url();?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>
</html>