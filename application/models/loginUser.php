<?php

class loginUser extends CI_Model{

    function login($user, $pass){
        
        $passwords=$this->getPasswords();

        foreach($passwords['pass'] as $password){
            if(password_verify($pass,$password))
                $VerifiedPass=$pass;
            else
                return false;
        }

        $query=$this->db
            ->select('idusuario, usuario, pass, correo, nombre, apellidos')
            ->from('usuarios')
            ->where('usuario="'.$user.'" AND pass="'.$VerifiedPass.'"')
            ->get();
        if($query->result()!=''){
            $this->session->set_userdata('isIn',true);
            $this->session->set_userdata('usuario',$query->result_array());
            return true;
        }
        else return false;
    }

    function isLogged(){

        if($this->session->userdata('isIn')==true)
            return true;
        else return false;

    }

    function getUsername(){
        
        echo "<div style='float:right;color:white'>Bienvenido: ". $this->session->userdata('nombre') .", ".
        $this->session->userdata('apellidos')."</div>";
        
    }

    function logOut(){

        $this->session->set_userdata('isIn',false);
        $this->session->unset_userdata('usuario');

    }

    function getPasswords(){

        $query=$this->db
        ->select('pass')
        ->from('usuarios')
        ->get();

        return $query->result_array();

    }

    



}