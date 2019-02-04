<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('register');
        $this->load->helper('form');
        include 'filtradoRegistro.php';
    }
    
    public function index()
	{
        $this->load->view('header');
        $provincias=$this->register->getProvincias();

        function VP($nombreCampo, $valorPorDefecto = '')
        {
            if (isset($_POST[$nombreCampo]))
                return $_POST[$nombreCampo];
            else
                return $valorPorDefecto;
        }


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
                    if ($error != '')
                        echo "<p style='color:red'>" . $error ."</p>";
                }
                $this->load->view('registro',['provincias'=>$provincias]);
            }
            else{
                $this->register->setRegistro($datos);
                $this->load->view('correct');
            }
           
        }

		else{
        
        $this->load->view('registro',['provincias'=>$provincias]);
        
        }
        $this->load->view('footer');
    }
    
    
	
}
