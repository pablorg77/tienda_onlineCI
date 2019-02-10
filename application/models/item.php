<?php

class item extends CI_Model{

    function getProducto($id){
        
        $query=$this->db
            ->select('*')
            ->from('productos')
            ->where('idproducto='.$id)
            ->get();
                return $query->result_array(); 
    }


}