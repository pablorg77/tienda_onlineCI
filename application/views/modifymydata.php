<?= form_open('Login/modifyUser'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php 
            $ci=get_instance();
            $ci->load->model('Loginuser');
            $data= $ci->Loginuser->getDataFromLoggedUser();
        ?>
            <div class="well well-sm">
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <legend class="text-center header">Modifique sus datos de contacto</legend>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">Usuario:
                                <input id="usuario" name="usuario" type="text" placeholder="<?=$data[0]['usuario']?>" class="form-control"
                                value="<?=set_value('usuario')?>">
                            </div>
                            <?= form_error('user');?>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">Contraseña:
                                <input id="pass" name="pass" type="password" placeholder="Nueva contraseña" class="form-control">
                            </div>
                            <?= form_error('pass');?>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">Correo:
                                <input id="correo" name="correo" type="text" placeholder="<?=$data[0]['correo']?>" class="form-control"
                                value="<?=set_value('correo')?>">
                            </div>
                            <?= form_error('correo');?>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user-square bigicon"></i></span>
                            <div class="col-md-8">Nombre:
                                <input id="nombre" name="nombre" type="text" placeholder="<?=$data[0]['nombre']?>" class="form-control"
                                value="<?=set_value('nombre')?>">
                            </div>
                            <?= form_error('nombre');?>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user-square bigicon"></i></span>
                            <div class="col-md-8">Apellidos:
                                <input id="apellidos" name="apellidos" type="text" placeholder="<?=$data[0]['apellidos']?>" class="form-control"
                                value="<?=set_value('apellidos')?>">
                            </div>
                            <?= form_error('apellidos');?>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user-square bigicon"></i></span>
                            <div class="col-md-8">DNI/NIF:
                                <input id="dni" name="dni" type="text" placeholder="<?=$data[0]['dni']?>" class="form-control"
                                value="<?=set_value('dni')?>">
                            </div>
                            <?= form_error('dni');?>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user-square bigicon"></i></span>
                            <div class="col-md-8">Dirección:
                                <input id="direccion" name="direccion" type="text" placeholder="<?=$data[0]['direccion']?>" class="form-control"
                                value="<?=set_value('direccion')?>">
                            </div>
                            <?= form_error('direccion');?>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user-square bigicon"></i></span>
                            <div class="col-md-8">Cod. Postal:
                                <input id="codpostal" name="codpostal" type="text" placeholder="<?=$data[0]['codpostal']?>" class="form-control"
                                value="<?=set_value('codpostal')?>">
                            </div>
                            <?= form_error('codpostal');?>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user-square bigicon"></i></span>
                            <div class="col-md-8">Provincia: 
                            <select name="provincia" value="<?=set_value('provincia')?>">
                            <?php foreach ($provincias as $prov):?>
                                    <option value='<?=$prov['provincia']?>'><?=$prov['provincia']?></option>";
                            <?php endforeach;?>
                            </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>