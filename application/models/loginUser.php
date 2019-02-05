<?php

class loginUser extends CI_Model{

    function login($user, $pass){
        
        $query=$this->db
            ->select('usuario, pass, correo, nombre, apellidos')
            ->from('usuarios')
            ->where('usuario="'.$user.'" AND pass="'.$pass.'"')
            ->get();
        if($query->result()!='')
            return $query->result_array();
        else return false;
    }

    /*function getUsuarios(){
        $query=$this->db
        ->select('usuario, pass, correo, nombre, apellidos')
        ->from('usuarios')
        ->get();
        return $query->result_array();
    }*/


}