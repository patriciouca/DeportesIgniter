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

   public function getIdTipopista($tipo){
       $query = $this->db->query("SELECT id FROM tipopista WHERE nombre=$tipo");
       return $query->result();
   }

    public function selectTipoPista(){
        $query = $this->db->query('SELECT * FROM tipopista');
        return $query->result();
    }

    public function insertPista($data){
       if($data['nombre']== null || $data['nombre'] == "")
           throw new Exception("No se puede crear una pista sin nombre");

        $this->db->insert('pista', $data);

    }

   public function insertTipoPista($data){
       if($data['nombre']== null || $data['nombre'] == "")
           throw new Exception("No se puede crear un tipo de pista sin nombre");
       $this->db->insert('tipopista', $data);
   }

}
