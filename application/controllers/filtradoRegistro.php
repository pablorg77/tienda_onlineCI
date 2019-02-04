<?php
function filtradoRegistro($datos){

    $arrayErrores=[];

    if ($datos['usuario'] == '') {
        $arrayErrores['usuario'] = "Introduzca un usuario";
    }

    if ($datos['pass'] == '') {
        $arrayErrores['pass'] = "Introduzca una contraseña";
    }

    if (! preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/", $datos['correo'])) {
        $arrayErrores['correo'] = "Introduzca un correo válido.";
    }

    if ($datos['nombre'] == '') {
        $arrayErrores['nombre'] = "Introduzca un nombre válido";
    }

    if ($datos['apellidos'] == '') {
        $arrayErrores['apellidos'] = "Introduzca apellidos válidos";
    }

    if (validaDNI($datos['dni'])) { 
        $arrayErrores['dni'] = "Introduzca un DNI válido.";
    }

    if ($datos['direccion'] == '') {
        $arrayErrores['direccion'] = "Introduzca una dirección válida";
    }

    if (! preg_match("/^[0-9]{5}$/", $datos['codpostal'])) {
        $arrayErrores['codpostal'] = "Introduzca un código postal válido";
    }

    
    return $arrayErrores;
}

function validaDNI($dni){

    $letra = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
    $num=intval(substr($dni,0,-1)) % 23;
    $letraDNI=$letra[$num];

    if (!(preg_match("/^[0-9]{8}/",$dni) && substr($dni,-1)===$letraDNI) )
        return true;
    else    return false;
  }
  
  