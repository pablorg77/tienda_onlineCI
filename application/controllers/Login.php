<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('loginUser');
        $this->load->library('session');
        include 'helper.php';
    }

	public function index()
	{
        
        if($this->input->post()){
        
            if($this->loginUser->login($this->input->post('username'),$this->input->post('password'))){
                
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

        $this->loginUser->logOut();
        redirect('login');
    }

	
}
