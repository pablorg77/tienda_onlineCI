<?php

class Articulos extends CI_Model{

    function getCategorias(){
        
        $query=$this->db
            ->select('*')
            ->from('categorias')
            ->get();
        return $query->result_array();
    }

    function getDestacados(){
        $fecha=date('Y-m-d');
        $query=$this->db
            ->select('*')
            ->from('productos')
            ->where('("'.$fecha.'" BETWEEN fechaInicio AND fechaFin) OR destacado=1')
            ->get();
        return $query->result_array();
    }

    function getNoDestacados($cat){
        $fecha=date('Y-m-d');
        $query=$this->db
        ->select('*')
        ->from('productos')
        ->where('("'.$fecha.'" "NOT" BETWEEN fechaInicio AND fechaFin OR destacado=0) AND categorias_idcategoria='.$cat)
        ->get();

        return $query->result_array();
    }

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

    function getMoreArticulos($pag,$offset,$cat){

        $fecha=date('Y-m-d');
        $query=$this->db
        ->select('*')
        ->from('productos')
        ->where('("'.$fecha.'" "NOT" BETWEEN fechaInicio AND fechaFin OR destacado=0) AND categorias_idcategoria='.$cat)
        ->limit($pag,$offset)
        ->get();

        return $query->result_array();

    }


}