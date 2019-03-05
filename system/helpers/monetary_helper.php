<?php defined('BASEPATH') OR exit('No direct script access allowed');


    function currency_SimboloMoneda(){

        $ci=get_instance();
        return $ci->session->userdata('type');
    }

    function currency_Importe($importe){
        
        $ci=get_instance();
        return round($importe * $ci->session->userdata('currency'),2);
    }
