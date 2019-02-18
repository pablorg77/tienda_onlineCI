<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Register');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function getForm(){
    
        $provincias=$this->Register->getProvincias();
        //$vistaRegistro=$this->load->view('registro',['provincias'=>$provincias],true);
        
         $this->form_validation->set_rules('user', 'User', 'required');
         $this->form_validation->set_rules('pass', 'Pass', 'trim|required|min_length[8]');
         $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
         $this->form_validation->set_rules('nombre', 'Nombre', 'required');
         $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
         $this->form_validation->set_rules('dni', 'DNI', 'trim|required|exact_length[9]|callback_validadni');
         $this->form_validation->set_rules('direccion', 'Direccion', 'required');
         $this->form_validation->set_rules('codpostal', 'Codpostal', 'trim|required|exact_length[5]');

         if ($this->form_validation->run() == FALSE)
             {
                     $this->load->view('plantilla',[
                         'cuerpo'=>$this->load->view('registro',['provincias'=>$provincias],true)
                         ]);
             }
             else
             {
                     $this->load->view('plantilla',[
                        'cuerpo'=>$this->load->view('correct')]);
                    $this->Register->setRegistro($this->input->post());
             }
         
    }
    
    public function validaDNI($dni){

        $letra = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
        $num=intval(substr($dni,0,-1)) % 23;
        $letraDNI=$letra[$num];
    
        if (substr($dni,-1)===$letraDNI)
            return true;
        else {   
            $this->form_validation->set_message('dni', 'El dni no es correcto');
            return false;
        }
      }
    
    
	
}
