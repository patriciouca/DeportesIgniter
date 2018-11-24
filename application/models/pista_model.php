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
        $this->db->insert('pista', $idPista,$nombre);

    }
   public function getIdTipopista($tipo){
       $query = $this->db->query("SELECT id FROM tipopista WHERE nombre=$tipo");
       return $query->result();
   }

    public function selectTipoPista(){
        $query = $this->db->query('SELECT * FROM tipopista');
        return $query->result();
    }

   public function insertTipoPista($data){
       $this->db->insert('tipopista', $data);

   }

}
