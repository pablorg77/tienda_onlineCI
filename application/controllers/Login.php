<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Loginuser');
        $this->load->library('session');
        $this->load->helper('form');
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

	
}
