<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Loginuser');
        $this->load->model('Emailme');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    /**
     * Se encarga de verificar la sesión, si existe el usuario en la base de datos, te envía a la página principal con
     * información referente a la cuenta en la cabecera de la aplicación. 
     */

	public function index()
	{
        
        if($this->input->post()){
        
            if($this->Loginuser->login($this->input->post('username'),$this->input->post('password'))){
                
                redirect('destacados');
            }
            else{
                
                $this->load->view('plantilla',[
                    'cuerpo'=>$this->load->view('failed', [], true)]);
            }
        }

        else{
            $this->load->view('plantilla',[
                'cuerpo'=>$this->load->view('login', [], true)]);
        }
        
    }

    /**
     * Simplemente hace una llamada a una función del modelo que se encarga de cerrar la sesión.
     */
    
    public function logOut(){

        $this->Loginuser->logOut();
        redirect('login');
    }
    
    /**
     * Se encarga de mostrar la vista principal de las opciones de la cuenta de usuario.
     *      
     */

    public function accOptions(){
        
        $this->load->view('plantilla',[
            'cuerpo'=>$this->load->view('options', [], true)]);

    }
    
    /**
     * En su llamada, se encarga de filtrar el formulario para modificar los datos del usuario que está en la sesión.
     */

    public function modifyUser(){

        $provincias=$this->Loginuser->getProvincias();
        
         $this->form_validation->set_rules('usuario', 'Usuario', 'required');
         $this->form_validation->set_rules('pass', 'Pass', 'trim|required|min_length[8]');
         $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
         $this->form_validation->set_rules('nombre', 'Nombre', 'required');
         $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
         $this->form_validation->set_rules('dni', 'DNI', 'trim|required|exact_length[9]|callback_validadni');
         $this->form_validation->set_rules('direccion', 'Direccion', 'required');
         $this->form_validation->set_rules('codpostal', 'Codpostal', 'trim|required|exact_length[5]');

         if ($this->form_validation->run() == FALSE)
             {
                     $this->load->view('plantilla',[
                         'cuerpo'=>$this->load->view('modifymydata',['provincias'=>$provincias],true)
                         ]);
             }
             else
             {
                     $this->load->view('plantilla',[
                        'cuerpo'=>$this->load->view('correct',[],true)]);
                    $this->Loginuser->modifyData($this->input->post());
             }
        
    }

   /**
    * Se encarga de plasmar una vista con unos botones de confirmar o cancelar para darse de baja o no.
    */

    public function darBaja(){

        $this->load->view('plantilla',[
            'cuerpo'=>$this->load->view('yousure',[],true)]);
        
        if($this->input->post('ok')){
            $this->Loginuser->deleteUser();
            $this->Loginuser->logOut();
            redirect('Login');    
        }
        elseif($this->input->post('notsure')){
            redirect('Login/accOptions');
        }
    }
    
    /**
     * Se encarga de, cuando la llaman, mostrar un formulario con un correo y un dni para verificar la existencia del usuario
     * en la base de datos. Seguidamente, si existe, recoge los datos del usuario mediante el correo y verifica la autenticidad
     * del dni con el de la base de datos; si es asi, llamaría a la función de verificar con un código hash creado a partir de su
     * DNI, sino mandaría a la vista de "error".
     */

    public function changePass(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
        $this->form_validation->set_rules('dni', 'DNI', 'trim|required|exact_length[9]');

        if ($this->form_validation->run() == FALSE)
             {
                $this->load->view('plantilla',[
                    'cuerpo'=>$this->load->view('checkEmailForPass',[],true)]);
        }
        else
        {

            $userData=$this->Loginuser->getDataFromEmail($this->input->post('correo'));

            if($userData){

                if($this->input->post('dni')==$userData->dni){

                    $encrypDNI=sha1($userData->dni);
                    $this->verifyAndChange($userData->idusuario,$encrypDNI);
                }
                else{
                    echo '<p style:"color:red"> No coincide el DNI con el suyo registrado, intentelo de nuevo</p>';
                    redirect('Login');
                }
            }
            else{
                $this->load->view('plantilla',[
                    'cuerpo'=>$this->load->view('failed',[],true)]);
            }
        }
     
    }

    /**
     * En esta función es en donde se verifica la existencia del usuario, y se encarga de enviar un correo al usuario que
     * recoge de nuevo de la base de datos mediante los parámetros que se le han dado. EN el correo se especifica la nueva
     * contraseña que tendrá este usuario que ha pedido una nueva clave. 
     * 
     */

    public function verifyAndChange($id, $hashCode){        

        $userData=$this->Loginuser->getDataFromId($id);

        $arrPasswords=array('maximusmus','pocoyoyo','kirikuku', 'mrwhiskers', 'imafailure', 'whyusocute');

        $newPass = $arrPasswords[mt_rand(0, count($arrPasswords) - 1)];

        $body="Usted ha solicitado un cambio de contraseña, que será: ".$newPass.". Si quiere cambiarla de nuevo por favor dirijase a ajustes";

        if(sha1($userData->dni)==$hashCode){

            $this->Loginuser->changePassFromId($id,$newPass);
            $this->Emailme->emailsomeone('prgdwes@gmail.com',$userData->nombre,'Recuperación de contraseña', $body);
            redirect('Login');
        }
        else{
            $this->load->view('plantilla',[
                'cuerpo'=>$this->load->view('failed',[],true)]);
        }
    }

    public function validaDNI($dni){

        $letra = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
        $num=intval(substr($dni,0,-1)) % 23;
        $letraDNI=$letra[$num];
    
        if (substr($dni,-1)===$letraDNI)
            return true;
        else {   
            $this->form_validation->set_message('dni', 'El dni no es correcto');
            return false;
        }
    }

    public function showPedidos(){

        
    }

	
}
