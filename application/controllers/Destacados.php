<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destacados extends CI_Controller {

	/**
	 * Se encarga simplemente de mostrar los articulos destacados en primera página, nada mas entrar a la aplicación,
	 * con su paginación correspondiente. 
	 */
	public function index($offset=0)
	{
	
		$this->load->model('Articulos');
		$destacados=$this->Articulos->getDestacados();
		$this->load->library('pagination');

		$config['base_url'] = site_url('Destacados/index');
		$config['total_rows'] = count($destacados);
		$config['per_page'] = 3;

		$this->pagination->initialize($config);

		$articulos=$this->Articulos->getArticulos($config['per_page'],$offset);

		$this->load->view('plantilla',
		['cuerpo'=>$this->load->view('principal',['articulos'=>$articulos],true)]);
		
	}

	/**
	 * Aqui muestro los artículos que no son destacados o no están en temporada, con su paginación correspondiente.
	 * 
	 */

	public function getArticulos($categoria,$offset=0){
		
		$this->load->model('Articulos');
		$this->load->library('pagination');
		$categorias=$this->Articulos->getCategorias();

		$noDestacados=$this->Articulos->getNoDestacados($categoria);

		$config['base_url'] = site_url('Destacados/getArticulos')."/".$categoria;
		$config['total_rows'] = count($noDestacados);
		$config['uri_segment']= 4;
		$config['per_page'] = 3;
	
		$this->pagination->initialize($config);

		$articulos=$this->Articulos->getMoreArticulos($config['per_page'],$offset,$categoria);

		$this->load->view('plantilla',[
			'cuerpo'=>$this->load->view('masarticulos',['articulos'=>$articulos,'cats'=>$categorias],true)]);
	}

	
}
