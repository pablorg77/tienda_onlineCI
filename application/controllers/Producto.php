<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Item');
    }

	public function index()
	{
        $product=$this->calculate();
        $desc=$this->isDiscounted();
        
        $this->load->view('plantilla',['cuerpo'=>
        $this->load->view('producto',['product'=>$product,'desc'=>$desc],true)]);
		
	}

	public function getProd(){

        $id=$this->input->get('prod');

        return $this->Item->getProducto($id);

    }

    public function calculate(){

        $product=$this->getProd();

        if($product[0]['descuento']!=null)
            $product[0]['descuento']=$product[0]['descuento'] + ($product[0]['descuento'] * $product[0]['iva']/100);
        

        $product[0]['precio']=$product[0]['precio'] + ($product[0]['precio'] * $product[0]['iva']/100);
        return $product;

        
        
    }

    public function isDiscounted(){

        $product=$this->calculate();

        if($product[0]['descuento']==null){

            return '<i><div name="precio">'.$product[0]["precio"].'€ (IVA incluido)</div></i>';
        }
        else{
            return '<i>Ahora<div name="descuento">'.$product[0]["descuento"].' € (IVA incluido)</div></i>
            <del><i>Antes<div name="precio">'.$product[0]["precio"].' € (IVA incluido)</div></i></del>';
        }
    }

	
}
