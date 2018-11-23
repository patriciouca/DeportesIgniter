<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Administrador extends CI_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->comprobar();
         $this->load->library(array('session'));
         $this->load->helper(array('url'));
     }

     public function comprobar()
     {
         /*
         if($this->session->get_userdata != null || $this->session->userdata('perfil') != 'administrador')
         {
             redirect(base_url().'login');
         }
         */
     }

     public function index()
     {

             $data['titulo'] = 'Bienvenido Administrador';
             $this->load->view('admin/header',$data);
             $this->load->view('admin/index',$data);
     }

     public function gestionar(){
         $data['titulo'] = 'Gestionar';
         $this->load->view('admin/header',$data);
         $this->load->view('admin/gestionar',$data);
     }
}