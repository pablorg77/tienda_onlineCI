<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mycart extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Item');
        $this->load->library('cart');
        $this->load->library('form_validation');
    }

	public function index()
	{
       
        $this->load->view('plantilla',[
            'cuerpo'=>$this->load->view('mycart', [], true)]);
        
    }

    public function add($id){

        $product=$this->Item->getProducto($id);
        $producto = array(
            'id'      => $id,
            'cant'     => $this->input->post('cant'),
            'precio'   => $product[0].precio + ($product[0].precio * $product[0].iva/100),
            'name'    => $product[0].nombre,
    );
    
        $this->cart->insert($producto);
        
        redirect('mycart');
    }

    public function update(){

        $this->cart->update();
        $this->load->view('plantilla',[
            'cuerpo'=>$this->load->view('mycart', [], true)]);
    }
    
	
}
