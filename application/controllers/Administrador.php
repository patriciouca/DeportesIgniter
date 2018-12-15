<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Administrador extends CI_Controller {
 
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
         $this->load->model('torneo_model');
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



     public function index($error=null)
     {

             $data['titulo'] = 'Bienvenido Admin';
             $tipoPistas = $this->pista_model->selectTipoPista();


             foreach ($tipoPistas as $tipoPista)
             {
                 $data['tipoPistas'][$tipoPista->id]=$tipoPista->nombre;
             }


             $this->load->view('admin/header',$data);

             if($error != null)
                 $this->load->view('error',array('error'=>$error));

             $this->load->view('admin/index',$data);
     }

    public function torneo($error=null)
    {

        $data['titulo'] = 'Torneo';
        $torneos = $this->torneo_model->selectTorneo();


        foreach ($torneos as $torneo)
        {
            $data['torneos'][$torneo->id]=$torneo->nombre;
        }


        $this->load->view('admin/header',$data);

        if($error != null)
            $this->load->view('error',array('error'=>$error));

        $this->load->view('admin/torneo',$data);
    }

    public function gestionar(){

        try{
             if($this->input->post('envTipoPista') != null )
             {
                 $dataTipoPista = array('nombre' => $this->input->post('nTipoPista'));
                 $this->pista_model->insertTipoPista($dataTipoPista);
                 $this->index();
             }
             else if($this->input->post('envPista') != null)
             {
                 $dataPista = array(
                     'idTipoPista' => $this->input->post('tipo_pista'),
                     'nombre' => $this->input->post('nPista'),
                 );

                     $this->pista_model->insertPista($dataPista);
                     $this->index();


             }
        }catch (Exception $e)
        {
            $this->index($e->getMessage());
        }
    }


    public function gestionarTorneo(){

        try{
            if($this->input->post('envTorneo') != null )
            {
                $dataTipoTorneo = array('nombre' => $this->input->post('nTorneo'));
                $this->torneo_model->insertTorneo($dataTipoTorneo);
                $this->torneo();
            }
            else if($this->input->post('envEquipo') != null)
            {
                $dataTipoEquipo = array('nombre' => $this->input->post('nEquipo'),'id_torneo' => $this->input->post('torneo'));
                $this->torneo_model->insertEquipo($dataTipoEquipo);
                $this->torneo();


            }
        }catch (Exception $e)
        {
            $this->torneo($e->getMessage());
        }
    }

    /*ALQUILER*/
    public function alquileres(){
        $this->load->view('alquiler/header');

        if(is_null($this->input->post('filtroFechaInicio')))
            $data = $this->alquiler_model->selectAlquiler();
        else{
            $where = $this->filtrarAlquiler($this->input->post('filtroFechaInicio'));
            $data = $this->alquiler_model->selectAlquiler($where);
        }

        $alquileres = Array();
        foreach ($data as $row){
            $rowPista = $this->pista_model->selectPista("id=".$row->idPista);
            $rowUsuario = $this->usuario_model->selectUsuario("id=".$row->idUsuario);
            foreach($rowPista as $pista)
                $nombrePista = $pista->nombre;
            foreach($rowUsuario as $usuario)
                $nombreUsuario = $usuario->nombre;

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
        $this->load->view('alquiler/index',$datos);

    }

    public function filtrarAlquiler($fechaInicio){

        $where = null;
        if($fechaInicio != null )
            $where = "fecha>="."'".$this->input->post('filtroFechaInicio')."'";

        return $where;

    }

    public function getEquipos($torneo)
    {
        $equipos = $this->torneo_model->selectEquipos("id_torneo=".$torneo);
        $response['success'] = 1;
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        echo json_encode($equipos);
    }


}