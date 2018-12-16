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
         $this->load->model('usuario_model');
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

    public function alquilar(){
        $fecha=$this->input->post('fecha');
        $hora=$this->input->post('hora');
        $usuario=$this->session->userdata('id_usuario');
        $precio=20;
        $pista=$this->input->post('pista');
        $alquiler=array("idUsuario"=> $usuario,"idPista" =>$pista,"fecha"=> $fecha,"precio"=> $precio,"horaInicio"=> $hora);
        $this->alquiler_model->insertAlquiler($alquiler);

    }

     public function pista($id)
     {
         $data['titulo'] = 'Pista';
         $pistaModelo = ($this->pista_model->selectPista("id='".$id."'"));

         $pista=array("pista" => $pistaModelo, "tipoPista" =>
             ($this->pista_model->selectTipoPista("id='".$pistaModelo->idTipoPista."'")));

         $this->load->view('cliente/header',$data);
         $this->load->view('cliente/pista', $pista);
     }

     public function disponibilidad($fecha)
     {
         $alquileres = $this->alquiler_model->selectAlquiler("fecha='".$fecha."' order by horaInicio asc");
         $response['success'] = 1;
         header('Content-Type: application/json');
         header('Access-Control-Allow-Origin: *');
         header("Access-Control-Allow-Methods: GET, OPTIONS");
         echo json_encode($alquileres);
     }

    public function horario($dia)
    {
        $horario = $this->pista_model->horario($dia);
        $response['success'] = 1;
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        echo json_encode($horario);
    }

    public function alquileres(){
        $this->load->view('cliente/header');

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
                    $row->precio."€",
                    $nombreUsuario
                )
            );
        }
        $datos['alquileres'] = $alquileres;
        $this->load->view('cliente/alquiler',$datos);

    }

    public function filtrarAlquiler($fechaInicio){

        $where = null;
        if($fechaInicio != null )
            $where = "fecha>="."'".$this->input->post('filtroFechaInicio')."'";

        return $where;

    }

    public function misDatos(){
        $this->load->view('cliente/header');
        $datos['nombre'] = 'aaron';
        $datos['apellidos'] = 'salinas sanchez';
        $datos['email'] = 'aron.salinas@gmail.com';
        $datos['tarjeta'] = '49120401lk';

        $this->load->view('cliente/cuenta',$datos);
    }

}