<?php

class Register extends CI_Model{
    
    
    /**
     * Registra un usuario en la bse de datos encriptando antes su contraseña.
     * 
     * @param array $data
     */
    function setRegistro($data){

        $newPass=password_hash($data['pass'], PASSWORD_DEFAULT);
        
        $this->db->query('INSERT INTO usuarios (usuario,pass,correo,nombre,apellidos,dni,direccion,codpostal,provincia) 
        VALUES ("'.$data["user"].'","'.$newPass.'","'.$data["correo"].'","'.$data["nombre"].'","'.$data["apellidos"].
        '","'.$data["dni"].'","'.$data["direccion"].'","'.$data["codpostal"].'","'.$data["provincia"].'")');
    }

    /**
     * Devuelve un array de provincias de España.
     * 
     * @return array
     */
    function getProvincias(){

        $query=$this->db
        ->select('*')
        ->from('provincias_es')
        ->get();

        return $query->result_array();
    }

    



}