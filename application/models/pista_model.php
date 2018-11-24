<?php
class Pista_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->database();
   }

    public function selectPista(){
        $query = $this->db->query('SELECT * FROM pista');
        return $query->result();
    }

    public function insertPista($idPista,$nombre){
        $this->db->query('INSERT INTO pista(idPista,nombre) VALUES($idPista,$nombre)');

    }
   public function selectTipoPista(){
       $query = $this->db->query('SELECT * FROM tipopista');
       return $query->result();
   }

   public function insertTipoPista($nombre){
       $this->db->query('INSERT INTO tipopista(nombre) VALUES($nombre)');

   }

}
