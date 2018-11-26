<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 26/11/2018
 * Time: 11:59
 */

class Alquiler extends CI_Controller
{
    public function __construct() {
        parent::__construct();

        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->helper(array('url','form'));
        $this->load->database('default');
        $this->load->model('usuario_model');
        $this->load->model('pista_model');
        $this->load->model('alquiler_model');
        $this->load->model('login_model');
    }


    public function index($error=null)
    {


        $data['alquileres'] = $this->alquileres();
        $this->load->view('alquiler/header');

        if($error != null)
            $this->load->view('error',array('error'=>$error));

        $this->load->view('alquiler/index',$data);
    }

    public function alquileres(){

        $data = $this->alquiler_model->selectAlquiler();
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
                    $row->precio,
                    $nombreUsuario
                )
            );
        }
        return $alquileres;

    }

    public function filtrarAlquiler($filtros){
        
    }
    public function filtrosToArray($filtros){
        $array = array(
            'fechaInicio' => $filtros['fechaInicio'],
            'fechaFin' => $filtros['fechaFin'],
            'status' => $filtros['tipoPista']
        );
        return $array;
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

}