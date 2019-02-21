<?php

class Loginuser extends CI_Model{

    function login($user, $pass){
        /*
        $passwords=$this->getPasswords();

        foreach($passwords['pass'] as $password){
            if(password_verify($pass,$password))
                $VerifiedPass=$pass;
            else
                return false;
        }*/

        $query=$this->db
            ->select('*')
            ->from('usuarios')
            ->where('usuario',$user)
            //->where('pass',$VerifiedPass)
            ->get();
        $user_data=$query->row();
        if ( !$user_data ){
            return false;
        }

        // Es correcta la clave
        if(! password_verify($pass,$user_data->pass)) {
            return false; //Si no coincide la clave;
        }
        
            $this->session->set_userdata('isIn',true);
            $this->session->set_userdata($user_data);
            return true;

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