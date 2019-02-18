<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	public function index()
	{
		$product=$this->getProd();
		
		//to=$this->load->view('producto',['product'=>$product],true);
        $this->load->view('plantilla',['cuerpo'=>
        $this->load->view('producto',['product'=>$product],true)]);
		
	}

	public function getProd(){

        $id=$_GET['prod'];
        $this->load->model('Item');

        return $this->Item->getProducto($id);

    }

	
}
