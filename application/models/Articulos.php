<?php

class Articulos extends CI_Model{
    
    /**
     * Recoge las categorias que hay en la base de datos.
     * 
     * @return array
     */
    function getCategorias(){
        
        $query=$this->db
            ->select('*')
            ->from('categorias')
            ->get();
        return $query->result_array();
    }
    
    /**
     * Recoge los articulos destacados o que estan en temporada.
     * 
     * @return array
     */
    function getDestacados(){
        $fecha=date('Y-m-d');
        $query=$this->db
            ->select('*')
            ->from('productos')
            ->where('("'.$fecha.'" BETWEEN fechaInicio AND fechaFin) OR destacado=1')
            ->get();
        return $query->result_array();
    }
    /**
     * Recoge los productos no destacados o no estan en temporada mediante la categoría que se les pase por parámetro.
     * 
     * @param int $cat
     * @return array
     */
    function getNoDestacados($cat){
        $fecha=date('Y-m-d');
        $query=$this->db
        ->select('*')
        ->from('productos')
        ->where('(!("'.$fecha.'" BETWEEN fechaInicio AND fechaFin) OR destacado=0) AND categorias_idcategoria='.$cat)
        ->get();

        return $query->result_array();
    }
    /**
     * Muestra los artículos destacados con paginación, controlada mediante parámetros.
     * 
     * @param int $pag
     * @param int $offset
     * @return array
     */
    function getArticulos($pag,$offset){
        $fecha=date('Y-m-d');
        $query=$this->db
        ->select('*')
        ->from('productos')
        ->where('("'.$fecha.'" BETWEEN fechaInicio AND fechaFin) OR destacado=1')
        ->limit($pag,$offset)
        ->get();

        return $query->result_array();
    }
    /**
     * Recoge los productos no destacados según categoría y paginándolos por parámetro.
     * 
     * @param int $pag
     * @param int $offset
     * @param int $cat
     * @return array
     */
    function getMoreArticulos($pag,$offset,$cat){

        $fecha=date('Y-m-d');
        $query=$this->db
        ->select('*')
        ->from('productos')
        ->where('(!("'.$fecha.'" BETWEEN fechaInicio AND fechaFin) OR destacado=0) AND categorias_idcategoria='.$cat)
        ->limit($pag,$offset)
        ->get();

        return $query->result_array();

    }


}