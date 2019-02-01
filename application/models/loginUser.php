<?php

class loginUser extends CI_Model{

    function login($user, $pass){
        
        $query=$this->db
            ->select('usuario, password')
            ->from('usuarios')
            ->where('usuario="'.$user.'" AND password="'.$pass.'"')
            ->get();
        if($query->result()!='')
            return true;
        else return false;
    }

    function getUsuario($id){
        $query=$this->db
        ->select('*')
        ->from('usuarios')
        ->where('idusuario='.$id)
        ->get();
        return $query->result_array();
    }


}