<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destacados extends CI_Controller {

	public function index()
	{

		$this->load->model('indexModel');
		$categorias=$this->indexModel->getCategorias();
		$destacados=$this->chooseCategoria();
		
		$principal=$this->load->view('principal',['destacados'=>$destacados,'cats'=>$categorias]);
		$this->load->view('plantilla',['view'=>$principal]);
	}

	private function chooseCategoria(){

		if(isset($_GET['categ']))
		$categoria=$_GET['categ'];
		else
			$categoria= 1; //Muestro los antivirus por defecto;

		return $this->indexModel->getDestacados($categoria);
	}
}
