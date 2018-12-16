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
			 $data['token'] = $this->token();
			 $data['titulo'] = 'Login con roles de usuario en codeigniter';
			 
			 break;
			 case 'administrador':
			 	redirect(base_url().'administrador');
			 break;
            case 'cliente':
                redirect(base_url(). 'cliente');
                break;
		}

		$this->load->view('header');
		$this->load->view('login',$data);
	}

	public function entrando()
	 {
	 	 /*
		 if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
		 {
		            //$this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
		            //$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[150]|xss_clean');
		 
		            //lanzamos mensajes de error si es que los hay
		    */
		 
		 $username = $this->input->post('username');
		 //$password = sha1($this->input->post('password'));
		 $password = $this->input->post('password');
		 
		 $check_user = $this->login_model->login_user($username,$password);

		 if($check_user == TRUE)
		 {
			 $data = array(
			                 'is_logued_in' => TRUE,
			                 'id_usuario' => $check_user->id,
			                 'perfil' => $this->usuario_model->getTipo($check_user->id_tipo),
			                 'username' => $check_user->username
			             );

			 $this->session->set_userdata($data);
			 $this->load->view('admin/header');
			 $this->load->view('admin/index');
		 }else{
		     $this->index();
		 }

	}

	 public function token()
	 {
	 	$token = md5(uniqid(rand(),true));
	 	$this->session->set_userdata('token',$token);
	 	return $token;
	 }

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
         /*if($this->input->post('nombre') == null OR $this->input->post('apellidos') == null OR
             $this->input->post('dni') == null OR $this->input->post('telefono') == null OR
             $this->input->post('tarjetaCredito') == null OR $this->input->post('username') == null OR
             $this->input->post('password') == null){

             print '<script language="JavaScript">';
             print 'alert("Rellena todos los campos por favor");';
             print '</script>';
             $this->load->view('header');
             $this->load->view('registro');

         else{*/
            if($this->input->post('dni') == null) {
                print '<script language="JavaScript">';
                print 'alert("Rellena todos los campos por favor");';
                print '</script>';
            }
             if($this->input->post('nombre') != null AND $this->input->post('apellidos') != null AND
                 $this->input->post('dni') != null AND $this->input->post('telefono') != null AND
                 $this->input->post('tarjetaCredito') != null AND $this->input->post('username') != null AND
                 $this->input->post('password') != null) {
                 $dataUsuario = array('id_tipo' => '1',
                     'nombre' => $this->input->post('nombre'),
                     'apellidos' => $this->input->post('apellidos'),
                     'dni' => $this->input->post('dni'),
                     'direccion' => 'Cadiz',
                     'telefono' => $this->input->post('telefono'),
                     'correo' => $this->input->post('username'),
                     'tarjetaCredito' => $this->input->post('tarjeta'),
                     'usuario' => $this->input->post('username'),
                     'password' => $this->input->post('password')
                 );
                 $this->usuario_model->insert($dataUsuario);
                 print '<script language="JavaScript">';
                 print 'alert("Usuario creado con éxito");';
                 print '</script>';
                 $this->index();
             }
         }






}
