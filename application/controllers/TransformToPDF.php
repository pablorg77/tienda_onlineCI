<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class TransformToPDF extends CI_Controller {

    function __construct(){
        parent::__construct();
        require 'vendor/autoload.php';
        $this->load->model('Loginuser');
        $this->load->model('Emailme');
    }

    /**
     * En su llamada se encarga de convertir en PDF el pedido del usuario que está en la sesión, abriendose en una ventana.
     * 
     */
 
    public function index()
    {
        $user=$this->Loginuser->getDataFromLoggedUser();
        $id=$user->idusuario;
        $fecha=date('Ymd-Hi');
        $location='../tienda_onlineCI/assets/pdf/';
        $name=$id.$fecha.'mycart.pdf';
        
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('receipt',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
        
    }
 
}