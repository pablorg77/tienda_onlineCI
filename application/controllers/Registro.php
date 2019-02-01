<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('register');
    }
    
    public function index()
	{
        $provincias=$this->register->getProvincias();

        if($_POST){

        }

		else{
        $this->load->view('header');
        $this->load->view('registro',['provincias'=>$provincias]);
        $this->load->view('footer');
        }
	}

	
}
