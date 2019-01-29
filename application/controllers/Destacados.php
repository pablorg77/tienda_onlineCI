<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destacados extends CI_Controller {

	public function index()
	{

		$this->load->model('tiendaDB');
		$categorias=$this->tiendaDB->getCategorias();
		
		$destacados=$this->chooseCategoria();
		$this->load->view('principal',['cats'=>$categorias,'destac'=>$destacados]);
	}

	private function chooseCategoria(){

		//$this->load->model('tiendaDB');
		if(isset($_GET['categ']))
		$categoria=$_GET['categ'];
		else
			$categoria= 1; //Muestro los antivirus por defecto;

		return $this->tiendaDB->getDestacados($categoria);
	}
}
