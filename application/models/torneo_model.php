<?php
class Torneo_model extends CI_Model {
   public function __construct() {
      parent::__construct();
      $this->load->database();
   }

    public function selectTorneo($where=null){

        $this->db->from('torneo');

        if($where == null){

            $query = $this->db->get();
            return $query->result();

        }

        $this->db->where($where,null,false);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertTorneo($data){
       if($data['nombre']== null || $data['nombre'] == "")
           throw new Exception("No se puede crear un torneo sin nombre");

        $this->db->insert('torneo', $data);

    }

   public function insertEquipo($data){
       if($data['nombre']== null || $data['nombre'] == "")
           throw new Exception("No se puede crear un equipo sin nombre");
       $this->db->insert('equipo', $data);
   }

    public function insertIntegrante($data){
        if($data['nombre']== null || $data['apellidos'] == "")
            throw new Exception("No se puede crear un integrante sin nombre o apellidos");
        $this->db->insert('integrante', $data);
    }

    public function selectEquipos($where=null){

        $this->db->from('equipo');

        if($where == null){

            $query = $this->db->get();
            return $query->result();

        }

        $this->db->where($where,null,false);
        $query = $this->db->get();
        return $query->result();
    }



}
