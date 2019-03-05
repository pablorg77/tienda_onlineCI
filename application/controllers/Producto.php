<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Item');
    }

    /**
     * Aquí se reocogen las acciones de las demás funciones y mostraría el producto en particular.
     */

	public function index()
	{
        $product=$this->calculate();
        $desc=$this->isDiscounted();
        
        $this->load->view('plantilla',['cuerpo'=>
        $this->load->view('producto',['product'=>$product,'desc'=>$desc],true)]);
		
    }
    
    /**
     * Devuelve un producto según el que esté registrado en la uri.
     */

	public function getProd(){

        $id=$this->input->get('prod');

        return $this->Item->getProducto($id);

    }

    /**
     * Se encarga simplemente de averiguar si el producto tiene descuento o no, y de calcular el precio total con el IVA incluido.
     */

    public function calculate(){

        $product=$this->getProd();

        if($product[0]['descuento']!=null)
            $product[0]['descuento']=$product[0]['descuento'] + ($product[0]['descuento'] * $product[0]['iva']/100);
        

        $product[0]['precio']=$product[0]['precio'] + ($product[0]['precio'] * $product[0]['iva']/100);
        return $product;

        
        
    }

    /**
     * Simplemente mostraría un "antes y ahora" de los precios actualizados si tiene descuento o no.
     */

    public function isDiscounted(){

        $product=$this->calculate();

        if($product[0]['descuento']==null){

            return '<i><div name="precio">'.round(currency_Importe($product[0]["precio"]),2).' '.currency_SimboloMoneda().' (IVA incluido)</div></i>';
        }
        else{
            return '<i>Ahora<div name="descuento">'.currency_Importe($product[0]["descuento"]).' '.currency_SimboloMoneda().' (IVA incluido)</div></i>
            <del><i>Antes<div name="precio">'.currency_Importe($product[0]["precio"]).' '.currency_SimboloMoneda().' (IVA incluido)</div></i></del>';
        }
    }

	
}
