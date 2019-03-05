<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mycart extends CI_Controller {
    

    function __construct(){
        parent::__construct();
        $this->load->model('Item');
        $this->load->model('Loginuser');
        $this->load->library('cart');
        $this->load->library('form_validation');
        $this->load->model('Emailme');
        require 'vendor/autoload.php';
    }

    /**
     * Se encarga de mostrar la vista del carrito.
     */

	public function index(){

        $this->load->view('plantilla',[
            'cuerpo'=>$this->load->view('mycart', [], true)]);
        
    }

    /**
     * En su llamada, se encarga de añadir un producto al carrito de la compra mediante el ID del producto, indicando
     * si tiene descuento o no para corregir el precio. 
     */

    public function add($id){

        $product=$this->Item->getProducto($id);

        if($this->Loginuser->getDataFromLoggedUser()!=''){
            $userLogged=$this->Loginuser->getDataFromLoggedUser();
            $idUser=$userLogged->idusuario;
        }
        else
            $idUser='';


        if($product[0]['descuento']!=null)
            $precio=$product[0]['descuento'] + ($product[0]['descuento'] * $product[0]['iva']/100);
        else
            $precio=$product[0]['precio'] + ($product[0]['precio'] * $product[0]['iva']/100);

        $producto = array(
            'id'      => $id,
            'qty'     => $this->input->post('cant'),
            'price'   => round(currency_Importe($precio),2),
            'name'    => $product[0]['nombre'],
            'img'     => $product[0]['imagen'],
            'idusuario' => $idUser
    );
    
        $this->cart->insert($producto);
        
        redirect('mycart');
    }

    /**
     * Se encarga de eliminar un solo producto del carrito mediante su $rowid.
     */

    public function delete($rowid){
	
		$data = array(
            'rowid'   => $rowid,
            'qty'     => 0
        );
        $this->cart->update($data);
        redirect('mycart');
    }

    /**
     * Eliminaría todos los productos del carrito.
     */

    public function deleteAll(){

        $this->cart->destroy();
        redirect('mycart');
    }

    /**
     * Se encarga de aceptar la compra que hay almacenada en el carrito, indicando antes si algún producto no está en stock
     * o has pedido demasiadas unidades. Seguidamente crearía un nuevo pedido con los datos de usuario y las respectivas lineas de 
     * pedido que incluiría dicho pedido.
     */

    public function acceptBuy(){

        if(!$this->Loginuser->isLogged()){

            redirect('Login');
        }

        $connectedUser=$this->Loginuser->getDataFromLoggedUser();

        $orderData=array(
            'usuarios_idusuario' => $connectedUser->idusuario,
            'total' => $this->cart->format_number($this->cart->total()),
            'estado'=> 'P',
            'nombre'=> $connectedUser->nombre,
            'apellidos'=> $connectedUser->apellidos,
            'dni'=> $connectedUser->dni,
            'direccion'=> $connectedUser->direccion,
            'codpostal'=> $connectedUser->codpostal,
            'provincia'=> $connectedUser->provincia
        );

        foreach ($this->cart->contents() as $items){

            if($this->Item->checkIfInStock($items['id'],$items['qty'])){
                echo 'El producto '.$items['name'].' no está en stock o ha pedido demasiadas unidades, solo hay'.
                $this->Item->getStock($items['id']).' unidades.';
                echo '<a href="'.site_url("mycart").'"> Volver al carrito ';
                return null;
            }
        }

        $this->Item->createOrder($orderData);
            
        $order=$this->Item->getOrderFromUserId($connectedUser->idusuario);

        //print_r($order);
    
        foreach ($this->cart->contents() as $items){

            $registeredProduct=array(
                'productos_idproducto'=> $items['id'],
                'cantidad'=> round(currency_Importe($items['qty']),2),
                'subtotal'=> $items['qty'] * round(currency_Importe($items['price']),2),
                'pedidos_idpedido'=> $order->idpedido
            );
            $this->Item->setLineaP($registeredProduct);
            $this->Item->setStock($items['id'],$items['qty']);
        }

        $id=$connectedUser->idusuario;
        $fecha=date('Ymd-Hi');
        $location='../tienda_onlineCI/assets/pdf/';
        $name=$id.$fecha.'mycart.pdf';
        
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('receipt',[],true);
        $mpdf->WriteHTML($html);
        //$mpdf->Output(); // opens in browser
        $mpdf->Output($location . $name,'F'); // it downloads the file into the user system, with give name

        $body='¡Gracias por confiar en mi tienda! Le enviamos un recibo para confirmar que su compra ha sido efectuada.
            Puede eliminar dicha compra antes de que se encuentre en estado de envío.';

        $this->Emailme->emailWithAttach($connectedUser->nombre,'Detalles de su compra',$body,$location.$name);
        $this->deleteAll();
        
    }

    
	
}
