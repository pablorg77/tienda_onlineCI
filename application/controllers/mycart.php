<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mycart extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Item');
        $this->load->library('cart');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

	public function index()
	{
       
        /*$config['base_url'] = site_url('mycart/index');
		$config['total_rows'] = count($this->cart->contents());
		$config['per_page'] = 10;

		$this->pagination->initialize($config);*/

        $this->load->view('plantilla',[
            'cuerpo'=>$this->load->view('mycart', [], true)]);
        
    }

    public function add($id){

        $product=$this->Item->getProducto($id);

        if($product[0]['descuento']!=null)
            $precio=$product[0]['descuento'] + ($product[0]['descuento'] * $product[0]['iva']/100);
        else
            $precio=$product[0]['precio'] + ($product[0]['precio'] * $product[0]['iva']/100);

        $producto = array(
            'id'      => $id,
            'qty'     => $this->input->post('cant'),
            'price'   => $precio,
            'name'    => $product[0]['nombre'],
            'img'     => $product[0]['imagen']
    );
    
        $this->cart->insert($producto);
        
        redirect('mycart');
    }

    public function delete($rowid){
	
		$data = array(
            'rowid'   => $rowid,
            'qty'     => 0
        );
        $this->cart->update($data);
        redirect('mycart');
    }


    
	
}
