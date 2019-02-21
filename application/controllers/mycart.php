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

    /*public function emailme(){

        $this->email->from('prgdwes@gmail.com', 'Kurgx');
        $this->email->to('prgdwes@gmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();

        redirect('Destacados');

        if($this->email->send()){

            redirect('Destacados');
        }

        else{
            show_error($this->email->print_debugger());
        }

       
    }*/
	
}
