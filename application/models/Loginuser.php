<?php

class Loginuser extends CI_Model{

    function login($user, $pass){

        $query=$this->db
            ->select('*')
            ->from('usuarios')
            ->where('usuario',$user)
            ->get();
        $user_data=$query->row();
        //print_r($user_data);
        if (!$user_data){
            return false;
        }

        // Es correcta la clave
        if(! password_verify($pass,$user_data->pass)) {
            return false; //Si no coincide la clave;
        }
            
            $this->session->set_userdata('isIn',true);
            $this->session->set_userdata('user',$user_data);
            return true;

    }

    function isLogged(){

        if($this->session->userdata('isIn')==true)
            return true;
        else return false;

    }

    function getUsername(){

        //print_r($this->session->userdata('user'));

        echo "<div style='float:right;color:white'>Bienvenido: ". $this->session->userdata('user')->nombre ." ".
        $this->session->userdata('user')->apellidos."</div>";
        
    }

    function logOut(){

        $this->session->set_userdata('isIn',false);
        $this->session->unset_userdata('usuario');

    }
    



}