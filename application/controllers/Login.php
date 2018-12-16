<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
		 $this->load->model('login_model');
         $this->load->model('usuario_model');
		 $this->load->library(array('session','form_validation'));
		 $this->load->helper('url'); 
		 $this->load->helper(array('url','form'));
		 $this->load->database('default');
    }

	public function index()
	{
		switch ($this->session->userdata('perfil')) {
			case '':
			 $data['titulo'] = 'Login con roles de usuario en codeigniter';
			 
			 break;
			 case '1':
			 	redirect(base_url().'administrador');
			 break;
            case '2':
                redirect(base_url(). 'cliente');
                break;
		}

		$this->load->view('header');
		$this->load->view('login',$data);
	}

	public function entrando()
	 {
		 
		 $username = $this->input->post('username');
		 //$password = sha1($this->input->post('password'));
		 $password = $this->input->post('password');
		 
		 $check_user = $this->login_model->login_user($username,$password);

		 if($check_user == TRUE)
		 {
			 $data = array(
			                 'is_logued_in' => TRUE,
			                 'id_usuario' => $check_user->id,
			                 'perfil' => $check_user->id_tipo,
			                 'username' => $check_user->usuario
			             );


			 $this->session->set_userdata($data);
             $this->index();

		 }else{
		     $this->index();
		 }

	}
    /*
	 public function token()
	 {
	 	$token = md5(uniqid(rand(),true));
	 	$this->session->set_userdata('token',$token);
	 	return $token;
	 }
    */

	 public function logout_ci()
	 {
		 $this->session->sess_destroy();
		 $this->index();
	 }

	 public function registro(){
         $this->load->view('header');
         $this->load->view('registro');

     }

     public function registrarUsuario(){
         $usuario['id_tipo'] = '1';
         $usuario['nombre'] = $this->input->post('nombre');
         $usuario['apellidos'] = $this->input->post('apellidos');
         $usuario['dni'] = $this->input->post('dni');
         $usuario['telefono'] = $this->input->post('telefono');
         $usuario['tarjetaCredito'] = $this->input->post('tarjeta');
         $usuario['usuario'] = $this->input->post('username');
         $usuario['password'] = $this->input->post('password');
         $this->usuario_model->insert($usuario);

     }

}
