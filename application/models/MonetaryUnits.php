<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class MonetaryUnits extends CI_Model {

    function getCurrency(){

        $url= 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

        $xml = simplexml_load_file($url);

        foreach($xml->Cube->Cube->Cube as $cub) {
            $types[]= (string) $cub['currency'];
            $valores[]= (float) $cub['rate'];
        }
        $newArray=array_combine($types,$valores);

        return $newArray;
    }

}