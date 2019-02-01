<?php

class indexModel extends CI_Model{

    function getCategorias(){
        
        $query=$this->db
            ->select('*')
            ->from('categorias')
            ->get();
        return $query->result_array();
    }

    function getDestacados($cat){
        $fecha=date('Y-m-d');
        $query=$this->db
            ->select('idproducto,nombre, precio, imagen, descripcion, cantidad_dispo, fechaInicio, fechaFin')
            ->from('productos')
            ->where('("'.$fecha.'" BETWEEN fechaInicio AND fechaFin OR destacado=1) AND categorias_idcategoria='.$cat)
            ->get();
        return $query->result_array(); 
    }


}