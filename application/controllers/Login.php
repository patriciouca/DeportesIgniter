<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
		 $this->load->model('login_model');
		 $this->load->library(array('session','form_validation'));
		 $this->load->helper('url'); 
		 $this->load->helper(array('url','form'));
		 $this->load->database('default');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
			                 'perfil' => "administrador",
			                 'username' => $check_user->username
			             ); 
			 $this->session->set_userdata($data);
			 $this->index();
		 }
		 
		 /*
		 }else{
		 	echo "hola";
		 	//redirect(base_url().'login');
		 }
		 */
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

}
