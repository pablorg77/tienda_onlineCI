<?php

class tiendaDB extends CI_Model{

    function getCategorias(){
        
        $query=$this->db
            ->select('*')
            ->from('categorias')
            ->get();
        return $query->result_array();
    }

    function getAntivirusDestacados(){

        $query=$this->db->select('nombre, precio, imagen, descripcion')
        ->from('productos')
        ->where('destacado=1 AND categorias_idcategoria=1')
        ->get();
        return $query->result_array(); 
    }

    function getCleanersDestacados(){

        $query=$this->db->select('nombre, precio, imagen, descripcion')
        ->from('productos')
        ->where('destacado=1 AND categorias_idcategoria=2')
        ->get();
        return $query->result_array(); 
    }

    function getJuegosDestacados(){

        $query=$this->db->select('nombre, precio, imagen, descripcion')
        ->from('productos')
        ->where('destacado=1 AND categorias_idcategoria=3')
        ->get();
        return $query->result_array(); 
    }


    function getCursosDestacados(){

        $query=$this->db->select('nombre, precio, imagen, descripcion')
        ->from('productos')
        ->where('destacado=1 AND categorias_idcategoria=4')
        ->get();
        return $query->result_array(); 
    }



   

}