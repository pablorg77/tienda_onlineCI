<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Loginuser');
        $this->load->model('Emailme');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

	public function index()
	{
        
        if($this->input->post()){
        
            if($this->Loginuser->login($this->input->post('username'),$this->input->post('password'))){
                
                redirect('destacados');
            }
            else{
                
                $this->load->view('plantilla',[
                    'cuerpo'=>$this->load->view('failed', [], true)]);
            }
        }

        else{
            $this->load->view('plantilla',[
                'cuerpo'=>$this->load->view('login', [], true)]);
        }
        
    }
    
    public function logOut(){

        $this->Loginuser->logOut();
        redirect('login');
    }

    public function accOptions(){
        
        $this->load->view('plantilla',[
            'cuerpo'=>$this->load->view('options', [], true)]);

    }

    public function modifyUser(){

        $provincias=$this->Loginuser->getProvincias();
        
         $this->form_validation->set_rules('usuario', 'Usuario', 'required');
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
                         'cuerpo'=>$this->load->view('modifymydata',['provincias'=>$provincias],true)
                         ]);
             }
             else
             {
                     $this->load->view('plantilla',[
                        'cuerpo'=>$this->load->view('correct',[],true)]);
                    $this->Loginuser->modifyData($this->input->post());
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

    public function darBaja(){

        $this->load->view('plantilla',[
            'cuerpo'=>$this->load->view('yousure',[],true)]);
        
        if($this->input->post('ok')){
            $this->Loginuser->deleteUser();
            $this->Loginuser->logOut();
            redirect('Login');    
        }
        elseif($this->input->post('notsure')){
            redirect('Login/accOptions');
        }
    }

    public function changePass($id){

        $user_data=$this->Loginuser->getDataFromLoggedUser();

        if($id!=$user_data[0]['idusuario']){
            
        }
    }

	
}
