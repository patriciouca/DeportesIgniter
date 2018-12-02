<?php
class Pista_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->database();
   }

    public function selectPista($where=null){

        $this->db->from('pista');

        if($where == null){

            $query = $this->db->get();
            return $query->result();

        }

        $this->db->where($where,null,false);
        $query = $this->db->get();
        return $query->result();
    }

    public function selectTipoPista($where=null){
        $this->db->from('tipopista');

        if($where == null){

            $query = $this->db->get();
            return $query->result();

        }

        $this->db->where($where,null,false);
        $query = $this->db->get();
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

    public function horario($dia)
    {
        $this->db->from('horario');


        $this->db->where("dia='".$dia."'", null, false);
        $query = $this->db->get();
        return $query->result();
    }

}
