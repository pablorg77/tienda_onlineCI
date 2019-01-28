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
			$categoria='Antivirus'; //Muestro los antivirus por defecto;

		if($categoria=='Antivirus')
			return $this->tiendaDB->getAntivirusDestacados();

		else if($categoria=='Cleaners')
			return $this->tiendaDB->getCleanersDestacados();
		
		else if($categoria=='Juegos')
			return $this->tiendaDB->getJuegosDestacados();

		else if($categoria=='Cursos')
			return $this->tiendaDB->getCursosDestacados();

		/*else
			return $this->tiendaDB->getAntivirusDestacados();*/
	}
}
