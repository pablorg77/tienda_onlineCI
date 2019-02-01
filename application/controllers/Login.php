<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('loginUser');
    }

	public function index()
	{
       
    /*if($_POST){
        $user=$_POST['user'];
        $pass=$_POST['pass'];

        if($this->login->login($user,$pass)){
            //$usuarioConectado=$this->loginOrRegister->getUsuario
        }
		
    }

    else*/
        
        $this->load->view('header');
        $this->load->view('login');
        $this->load->view('footer');
	}

	
}
