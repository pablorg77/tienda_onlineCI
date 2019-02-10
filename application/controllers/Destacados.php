<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destacados extends CI_Controller {

	public function index()
	{
		$this->getPag();
		$this->load->model('indexModel');
		$categorias=$this->indexModel->getCategorias();
		$destacados=$this->chooseCategoria();
		$principal=$this->load->view('principal',['destacados'=>$destacados,'cats'=>$categorias],true);
		$this->load->view('plantilla',['cuerpo'=>$principal]);
		
	}

	private function chooseCategoria(){

		if(isset($_GET['categ']))
		$categoria=$_GET['categ'];
		else
			$categoria= 1; //Muestro los antivirus por defecto;

		return $this->indexModel->getDestacados($categoria);
	}

	private function getPag(){

		$this->load->library('pagination');

		$config['base_url'] = base_url();
		$config['total_rows'] = 10;
		$config['per_page'] = 3;

		$this->pagination->initialize($config);
	}

	
}
