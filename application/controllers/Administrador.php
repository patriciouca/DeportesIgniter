<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Administrador extends CI_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->comprobar();
         $this->load->library(array('session'));
         $this->load->helper(array('url'));
         $this->load->helper(array('url','form'));
         $this->load->database('default');
         $this->load->model('pista_model');
         $this->load->model('login_model');
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

             $data['titulo'] = 'Bienvenido Admin';
             $tipoPistas = $this->pista_model->selectTipoPista();


             foreach ($tipoPistas as $tipoPista)
             {
                 $data['tipoPistas'][$tipoPista->id]=$tipoPista->nombre;
             }


             $this->load->view('admin/header',$data);
             $this->load->view('admin/index',$data);
     }

    public function dataSubmitted(){
        $dataPista = array('idTipoPista' => $this->input->post('nTipoPista'),
            'nombre' => $this->input->post('nPista'),
        );
        $dataTipoPista = array('nombre' => $this->input->post('nTipoPista'));

        $this->pista_model->insertTipoPista($dataTipoPista);

    }
     /*
     public function gestionar(){
         $data['titulo'] = 'Gestionar';
         echo $this->pista_model->getTipoPistas();
         $this->load->view('admin/header',$data);
         $this->load->view('admin/gestionar',$data);
     }
     */
}