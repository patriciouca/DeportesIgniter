<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

class Cliente extends CI_Controller {
 
     public function __construct() {
         parent::__construct();
         $this->load->library(array('session'));
         $this->load->helper(array('url','form'));
         $this->load->database('default');
         $this->load->model('pista_model');
         $this->load->model('alquiler_model');
         $this->load->model('torneo_model');
         $this->load->model('usuario_model');
         $this->comprobar();
     }

     public function comprobar()
     {
         try{
             if($this->session->userdata('perfil')== null || $this->session->userdata('perfil') != 2)
             {
                 redirect(base_url().'login');
             }
         }catch(Exception $e)
         {
             redirect(base_url().'login');
         }

     }

     public function borrar($accion,$id,$error=null){
        if($accion=="integrante")
        {
            $this->torneo_model->borrarIntegrante($id);
            $this->misDatos();
        }
     }

     public function index($error=null){
         $data['titulo'] = 'Bienvenido Cliente';

         $this->alquileres();
     }

    public function meterFondos($error=null){

        $usuario=($this->usuario_model->selectUsuario("id='".($this->session->userdata('id_usuario'))."'"))[0];
        if(isset($usuario->tarjetaCredito))
        {
            $dinero=$this->input->post('fondos');
            $this->usuario_model->setSaldoUsuario($usuario->id,$usuario->saldo+$dinero);
            $this->misDatos();
        }
        else{
            $this->misDatos("Tarjeta de credito no valida");
        }


    }

    public function Ltorneo($error=null){

        $data['titulo'] = 'Torneo';
        $data['torneos'] = $this->torneo_model->selectTorneo();

        $this->load->view('cliente/header',$data);

        if($error != null)
            $this->load->view('error',array('error'=>$error));

        $this->load->view('listadoTorneo',$data);
    }

    public function verTorneo($id_torneo,$error=null)
    {
        $torneo=($this->torneo_model->selectTorneo("id='".$id_torneo."'"))[0];
        $data['titulo'] = 'Tabla '.$torneo->nombre;
        $encuentros=$this->torneo_model->selectEncuentros($id_torneo);

        foreach ($encuentros as $encuentro)
        {

            $encuentro->equipo1=($this->torneo_model->selectEquipos("id='".
                $encuentro->id_equipo1."'"))[0]->nombre;

            $encuentro->equipo2=($this->torneo_model->selectEquipos("id='".
                $encuentro->id_equipo2."'"))[0]->nombre;

        }

        $data['encuentros'] = $encuentros;
        $data['id_torneo'] = $id_torneo;

        $data['encuentrosPfase'] = $this->torneo_model->encuentrosPrimeraFase($id_torneo);
        $this->load->view('cliente/header',$data);

        if($error != null)
            $this->load->view('error',array('error'=>$error));

        $this->load->view('verTorneo',$data);
    }

    public function torneo($error=null)
    {

        $data['titulo'] = 'Torneo';
        $torneos = $this->torneo_model->selectTorneo();
        $tipoPista = $this->pista_model->selectTipoPista();


        foreach ($torneos as $torneo)
        {
            $data['torneos'][$torneo->id]=$torneo->nombre;
        }

        foreach ($tipoPista as $torneo)
        {
            $data['tipoTorneos'][$torneo->id]=$torneo->nombre;
        }


        $this->load->view('admin/header',$data);

        if($error != null)
            $this->load->view('error',array('error'=>$error));

        $this->load->view('admin/torneo',$data);
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
         $pistaModelo = ($this->pista_model->selectPista("id='".$id."'"))[0];

         $pista=array("pista" => $pistaModelo, "tipoPista" =>
             ($this->pista_model->selectTipoPista("id='".$pistaModelo->idTipoPista."'"))[0]);

         $this->load->view('cliente/header',$data);
         $this->load->view('cliente/pista', $pista);
     }

     public function disponibilidad($fecha,$id)
     {
         $alquileres = $this->alquiler_model->selectAlquiler("idPista='".$id."' and fecha='".$fecha."' order by horaInicio asc");
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
        $datos['titulo']="Alquileres";
        $this->load->view('cliente/header',$datos);
        $this->load->view('cliente/alquiler',$datos);

    }

    public function filtrarAlquiler($fechaInicio){

        $where = null;
        if($fechaInicio != null )
            $where = "fecha>="."'".$this->input->post('filtroFechaInicio')."'";

        return $where;

    }

    public function equipo($id,$error=null){


         $datos['equipo']=($this->torneo_model->selectEquipos("id='".$id."'"))[0];
        $datos['titulo']="Equipo ".$datos['equipo']->nombre;
        $datos['integrantes']=$this->torneo_model->selectIntegrantes("id_equipo='".$id."'");
        $this->load->view('cliente/header',$datos);
        if($error != null)
            $this->load->view('error',array('error'=>$error));
        $this->load->view('equipo',$datos);

    }

    public function misDatos($error=null){
         $usuario=($this->usuario_model->selectUsuario("id='".($this->session->userdata('id_usuario'))."'"))[0];

         $datos['titulo']="Mis datos";

        $datos['usuario']=$usuario;

        $datos['torneos']=$this->torneo_model->selectMisTorneos($this->session->userdata('id_usuario'));

        $this->load->view('cliente/header',$datos);
        if($error != null)
            $this->load->view('error',array('error'=>$error));
        $this->load->view('cliente/cuenta',$datos);
    }

    public function integrante(){
        $nombre=$this->input->post('nombre');
        $apellidos=$this->input->post('apellidos');
        $equipo=$this->input->post('equipo');
        $dataIntegrante=array('id_usuario'=>-1,'nombre'=>$nombre,'apellidos'=>$apellidos,'id_equipo'=>$equipo);
        $this->torneo_model->insertIntegrante($dataIntegrante);
        $this->misDatos();

    }



}