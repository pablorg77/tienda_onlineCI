
<?= form_open('Login/changePass'); ?>
<form method="post">
<fieldset style="padding:100px">
    <legend> Introduzca su correo y DNI </legend>
    <p> Correo: <input type="text" name="correo" placeholder="correo@example.com" value="<?=set_value('correo')?>"/></p>
        <?= form_error('correo');?>
    <p> DNI/NIF: <input type="text" name="dni" placeholder="00000000X" value="<?=set_value('dni')?>"/></p>
        <?= form_error('dni');?>
    <input type="submit" value="Comprobar"/>
</fieldset>
</form>