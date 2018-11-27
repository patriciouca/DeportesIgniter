<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Cliente extends CI_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->comprobar();
         $this->load->library(array('session'));
         $this->load->helper(array('url'));
         $this->load->helper(array('url','form'));
         $this->load->database('default');
         $this->load->model('usuario_model');
         $this->load->model('pista_model');
         $this->load->model('alquiler_model');
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

     public function index($error=null){
         $data['titulo'] = 'Bienvenido Cliente';

         $data['opciones'][0] = 'Alquilar Pista';
         $data['opciones'][1] = 'Unirse a Torneo';


         $this->load->view('cliente/header',$data);

         if($error != null)
             $this->load->view('error',array('error'=>$error));

         $this->load->view('cliente/index',$data);
     }

    public function alquileresUsuario(){
        $this->load->view('alquiler/header');
        $data = $this->alquiler_model->selectAlquiler("idUsuario="."'"."2"."'");
        $rowUser = $this->usuario_model->selectUsuario("id="."'"."2"."'");
        foreach ($rowUser as $usuario)
            $nombreUsuario = $usuario->nombre;
        $alquileres = Array();
        foreach ($data as $row){
            $rowPista = $this->pista_model->selectPista("id=".$row->idPista);
            foreach($rowPista as $pista)
                $nombrePista = $pista->nombre;

            array_push($alquileres,
                array(
                    $row->id,
                    $row->fecha,
                    $nombrePista,
                    $row->horaInicio,
                    $row->horaFin,
                    $row->precio."€",
                    $nombreUsuario
                )
            );
        }
        $datos['alquileres'] = $alquileres;
        $this->load->view('alquilerUsuario/index',$datos);
    }



}