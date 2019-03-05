<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GroceryCRUD extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->model('Loginuser');
	}

	/**
	 * Crea un CRUD de los productos que hay en la base de datos mediante Grocery CRUD.
	 * 
	 */

	public function showProducts(){
		
			$crud = new grocery_CRUD();
			$crud->set_table('productos');
			$crud->columns('nombre','codigo','descripcion','precio', 'cantidad_dispo');
			 
			$output = $crud->render();
			 
			$this->_example_output($output);
			
	}

	/**
	 * Crea un CRUD de los pedidos que hay en la base de datos mediante Grocery CRUD.
	 * 
	 */

	public function showOrders(){
		
		$crud = new grocery_CRUD();
		$crud->set_table('pedidos');
		$crud->columns('nombre','apellidos','total','estado','fechaCreacion');
		 
		$output = $crud->render();
		 
		$this->_example_output($output);
		
	}

	/**
	 * Crea un CRUD de las categorias que hay en la base de datos mediante Grocery CRUD.
	 * 
	 */

	public function showCategorias(){

		$crud = new grocery_CRUD();
		$crud->set_table('categorias');
		$crud->columns('nombre','codigo','descripcion');
		 
		$output = $crud->render();
		 
		$this->_example_output($output);
	}

	/**
	 * Muestra la vista del CRUD y devuelve lo que se vaya eligiendo.
	 * 
	 */

	public function _example_output($output = null)
	{
		$this->load->view('CRUD.php',(array)$output);
	}

	

}
