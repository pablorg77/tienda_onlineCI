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
       //$this->load->view('header');
       //$usuarios=$this->loginUser->getUsuarios();

        if($_POST){
            
        //foreach($usuarios as $usuario){
            if($this->loginUser->login($_POST['username'],$_POST['password'])!=''){
                $this->session->set_userdata('usuario',$this->loginUser->login($_POST['username'],$_POST['password']));
                //$_SESSION['usuario']=$usuario;
                //header('Location:'.base_url());
                redirect('destacados');
            }
            else{
                //$this->load->view('plantilla',['view'=>$this->load->view('failed')]);
                
                $this->load->view('plantilla',['view'=>$this->load->view('failed')]);
            }
        //}
		
        }

        else{
            $this->load->view('plantilla',['view'=>$this->load->view('login')]);
        }
        
        //$this->load->view('footer');
    }
    
    public function logOut(){

        $this->session->sess_destroy();
        redirect('login');
    }

    public function showError(){

        $this->load->view('plantilla',['view'=>$this->load->view('failed')]);
    }

	
}
