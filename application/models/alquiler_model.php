<?php
class Alquiler_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
       $this->load->database();
   }
    public function selectAlquiler(){
        $query = $this->db->query('SELECT * FROM alquiler');
        return $query->result();
    }

    public function insertAlquiler($idUsuario,$idPista,$fecha,$precio,$horaInicio,$horaFin){
        $query = $this->db->query('INSERT INTO alquiler(idUsuario,idPista,fecha,precio,horaInicio,horaFin)
                  VALUES($idUsuario,$idPista,$fecha,$precio,$horaInicio,$horaFin)');


    }

}