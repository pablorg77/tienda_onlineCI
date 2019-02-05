<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('register');
        $this->load->helper('form');
        include 'filtradoRegistro.php';
        include 'helper.php';
    }
    
    public function index()
	{
        //$this->load->view('header');
        $provincias=$this->register->getProvincias();
        $vistaRegistro=$this->load->view('registro',['provincias'=>$provincias]);

        if($_POST){
    
            $datos=[
                'usuario'=>$_POST['user'],
                'pass'=>$_POST['pass'],
                'correo'=>$_POST['correo'],
                'nombre'=>$_POST['nombre'],
                'apellidos'=>$_POST['apellidos'],
                'dni'=>$_POST['dni'],
                'direccion'=>$_POST['direccion'],
                'codpostal'=>$_POST['codpostal'],
                'provincia'=>$_POST['provincia']
            ];

            $errores=filtradoRegistro($datos);
            if ($errores) {
                foreach ($errores as $error) {
                    if ($error != '')   //Podría colocar cada error en un div en rojo debajo de cada campo.
                        echo "<p style='color:red'>" . $error ."</p>";
                }
                $this->load->view('plantilla',['view'=>$vistaRegistro]);
            }
            else{
                $this->register->setRegistro($datos);
                $this->load->view('plantilla',['view'=>$this->load->view('correct')]);
            }
           
        }

		else{
        
            $this->load->view('plantilla',['view'=>$vistaRegistro]);
        
        }
        //$this->load->view('footer');
    }
    
    
	
}
