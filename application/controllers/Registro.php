<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('register');
        $this->load->model('filtradoregistro');
    }
    
    public function index()
	{
        $provincias=$this->register->getProvincias();

        if($_POST){
            $datos={
                'usuario'=>$_POST['user'],
                'pass'=>$_POST['pass'],
                'correo'=>$_POST['correo'],
                'nombre'=>$_POST['nombre'],
                'apellidos'=>$_POST['apellidos'],
                'dni'=>$_POST['dni'],
                'direccion'=>$_POST['direccion'],
                'codpostal'=>$_POST['codpostal'],
            };

            $errores=$this->filtradoRegistro->filtradoRegistro($datos);

        }

		else{
        $this->load->view('header');
        $this->load->view('registro',['provincias'=>$provincias]);
        $this->load->view('footer');
        }
	}

	
}
