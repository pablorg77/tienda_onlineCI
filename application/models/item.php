<?php

class Item extends CI_Model{
    
    
    /**
     * Devuelve un producto según el ID que se le especifique.
     * 
     * @param int $id
     * @return array
     */
    function getProducto($id){
        
        $query=$this->db
            ->select('*')
            ->from('productos')
            ->where('idproducto='.$id)
            ->get();
                return $query->result_array(); 
    }
    /**
     * Introduce un nuevo pedido en la base de datos con la información que se le pase por parámetro.
     * 
     * @param array $data
     */
    function createOrder($data){
        $this->db
        ->insert('pedidos',$data);
    }
    /**
     * Recoge el pedido del usuario que se le indique por parámetro y que su estado esté aún en envío.
     * 
     * @param int $id
     * @return array
     */
    function getOrderFromUserId($id){

        $query=$this->db
            ->select('*')
            ->from('pedidos')
            ->where('usuarios_idusuario='.$id.' AND estado="P"')
            ->get();
                return $query->row(); 
    }
    /**
     * Crea una nueva línea de pedido con la información que se le proporciona.
     * 
     * @param array $data
     */
    function setLineaP($data){

        $this->db
        ->insert('linea_pedido',$data);
    }
    /**
     * Comprueba que el producto indicado esté en Stock o que el numero de unidades que ha pedido el usuario no es mayor al que
     * hay en la base de datos.
     * 
     * @param int $id
     * @param int $cant
     * @return boolean
     */
    function checkIfInStock($id,$cant){

        $query=$this->db
            ->select('cantidad_dispo')
            ->from('productos')
            ->where('idproducto='.$id)
            ->get();
                $product = $query->row();
        if($product->cantidad_dispo > $cant)
            return false;
        else
            return true;
    }

    /**
     * Devuelve el numero de cantidades disponibles que hay de un producto.
     * 
     * @param int $id
     * @return int
     */
    function getStock($id){

        $query=$this->db
            ->select('cantidad_dispo')
            ->from('productos')
            ->where('idproducto='.$id)
            ->get();
                $product = $query->row();
                return $product->cantidad_dispo;

    }

    /**
     * Actualiza el stock de cada producto que se le haya pasasdo por parámetro.
     * 
     * @param int $id
     * @param int $cant
     */
    function setStock($id,$cant){

        $product=$this->getStock($id);
        $newStock=$product - $cant;

        $this->db
        ->set('cantidad_dispo', $newStock)
        ->where('idproducto',$id)
        ->update('productos');
    }


}