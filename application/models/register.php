<?php

class register extends CI_Model{

    function setRegistro($data){
        
        $this->db->query('INSERT INTO usuarios (usuario,pass,correo,nombre,appellidos,dni,direccion,codpostal,provincia) 
        VALUES ("'.$data["user"].'","'.$data["pass"].'","'.$data["correo"].'","'.$data["nombre"].'","'.$data["apellidos"].
        '","'.$data["dni"].'","'.$data["direccion"].'","'.$data["codpostal"].'","'.$data["provincia"].'")');
    }

    function getProvincias(){

        $query=$this->db
        ->select('*')
        ->from('provincias_es')
        ->get();

        return $query->result_array();
    }



}