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

    function getDataFromLoggedUser(){

        $query=$this->db
        ->select('*')
        ->from('usuarios')
        ->where('idusuario',$this->session->userdata('user')->idusuario)
        ->get();
            return $query->result_array();
    }

    function getUsername(){

        echo "<div style='float:right;color:white'>Bienvenido: ". $this->session->userdata('user')->nombre ." ".
        $this->session->userdata('user')->apellidos."</div>";
        
    }

    function modifyData($user_data){

        $user_data['pass']=password_hash($user_data['pass'], PASSWORD_DEFAULT);

        $this->db
        ->update('usuarios', $user_data, 'idusuario='.$this->session->userdata('user')->idusuario);
        
    }

    function deleteUser(){

        $this->db->where('idusuario', $this->session->userdata('user')->idusuario);
        $this->db->delete('usuarios');

    }

    function logOut(){

        $this->session->set_userdata('isIn',false);
        $this->session->unset_userdata('usuario');

    }

    function getProvincias(){

        $query=$this->db
        ->select('*')
        ->from('provincias_es')
        ->get();

        return $query->result_array();
    }
    



}