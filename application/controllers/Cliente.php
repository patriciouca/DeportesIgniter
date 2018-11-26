<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Cliente extends CI_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->comprobar();
         $this->load->library(array('session'));
         $this->load->helper(array('url','form'));
         $this->load->database('default');
         $this->load->model('pista_model');
         $this->load->model('alquiler_model');
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

     public function index($error=null){
         $data['titulo'] = 'Bienvenido Cliente';

         $data['opciones'][0] = 'Alquilar Pista';
         $data['opciones'][1] = 'Unirse a Torneo';


         $this->load->view('cliente/header',$data);

         if($error != null)
             $this->load->view('error',array('error'=>$error));

         $this->load->view('cliente/index',$data);
     }

     public function pista($id)
     {
         $data['titulo'] = 'Pista';
         $pistaModelo=($this->pista_model->selectPista("id='".$id."'"))[0];

         $pista=array("pista" => $pistaModelo, "tipoPista" =>
             ($this->pista_model->selectTipoPista("id='".$pistaModelo->idTipoPista."'"))[0]);

         $this->load->view('cliente/header',$data);
         $this->load->view('cliente/pista', $pista);
     }

     public function disponibilidad($fecha)
     {
         $alquileres=$this->alquiler_model->selectAlquiler("fecha='".$fecha."'");

         return $alquileres;
     }


}