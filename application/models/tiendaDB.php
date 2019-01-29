<?php

class tiendaDB extends CI_Model{

    function getCategorias(){
        
        $query=$this->db
            ->select('*')
            ->from('categorias')
            ->get();
        return $query->result_array();
    }

    function getDestacados($cat){

        $query=$this->db->select('nombre, precio, imagen, descripcion, cantidad_dispo')
        ->from('productos')
        ->where('destacado=1 AND categorias_idcategoria='.$cat)
        ->get();
        return $query->result_array(); 
    }


   

}