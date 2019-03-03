<?php

class Loginuser extends CI_Model{

    /**
     * Comprueba la existencia del usuario en la base de datos, verificando por hash la contraseña que se le ha dado por parámetro.
     * 
     * @param string $user
     * @param string $pass
     * @return boolean
     */
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
            //CI_Input::set_cookie('usuario',$user_data->idusuario);
            return true;

    }

    /**
     * Comprueba que hay alguna sesión iniciada.
     * 
     * @return boolean
     */
    function isLogged(){

        if($this->session->userdata('isIn')==true)
            return true;
        else return false;

    }

    /**
     * Devuelve información sobre el usuario que está en la sesión actual.
     * 
     * @return array
     */
    function getDataFromLoggedUser(){

        if($this->isLogged())
            $id=$this->session->userdata('user')->idusuario;
        else
            $id='';

        $query=$this->db
        ->select('*')
        ->from('usuarios')
        ->where('idusuario',$id)
        ->get();
            return $query->row();
    }

    /**
     * Devuelve información de un usuario según el email que se especifique.
     * 
     * @param string $correo
     * @return array
     */
    function getDataFromEmail($correo){

        $query=$this->db
        ->select('*')
        ->from('usuarios')
        ->where('correo',$correo)
        ->get();
            return $query->row();

    }

    /**
     * Devuelve información de un usuario según el DNI que se le especifique.
     * 
     * @param string $dni
     * @return array
     */
    function getDataFromDNI($dni){

        $query=$this->db
        ->select('*')
        ->from('usuarios')
        ->where('dni',$dni)
        ->get();
            return $query->row();

    }

    /**
     * Devuelve información de un usuario según el ID de usuario que se le especifique.
     * 
     * @param int $id
     * @return array
     */
    function getDataFromId($id){

        $query=$this->db
        ->select('*')
        ->from('usuarios')
        ->where('idusuario',$id)
        ->get();
            return $query->row();

    }

    /**
     * Actualizaría la contraseña que se le especifique, encriptandola además, del usuario que se le pase por parámetro.
     * 
     * @param int $id
     * @param string $newPass
     */
    function changePassFromId($id, $newPass){

        $newPass=password_hash($newPass, PASSWORD_DEFAULT);

        $this->db
        ->set('pass', $newPass)
        ->where('idusuario',$id)
        ->update('usuarios');

    }

    /**
     * Sirve para mostrar en la cabecera de la web el usuario que está en la sesión.
     */
    function getUsername(){

        echo "<div style='float:right;color:white'>Bienvenido: ". $this->session->userdata('user')->nombre ." ".
        $this->session->userdata('user')->apellidos."</div>";
        
    }

    /**
     * Modifica los datos que hay en la base de datos dependiendo del usuario que está en la sesión actual.
     * 
     * @param array $user_data
     */
    function modifyData($user_data){

        $user_data['pass']=password_hash($user_data['pass'], PASSWORD_DEFAULT);

        $this->db
        ->update('usuarios', $user_data, 'idusuario='.$this->session->userdata('user')->idusuario);
        
    }

    /**
     * Elimina el usuario que está en la sesión actual y cierra sesión.
     */
    function deleteUser(){

        $this->db->where('idusuario', $this->session->userdata('user')->idusuario);
        $this->db->delete('usuarios');
        $this->logOut();
    }

    /**
     * Cierra la sesión existente.
     */
    function logOut(){

        $this->session->set_userdata('isIn',false);
        $this->session->unset_userdata('usuario');

    }

    /**
     * Devuelve un array de todas las provincias de España.
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