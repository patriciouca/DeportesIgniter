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

    public function insertAlquiler($data){
        $this->db->insert('alquiler', $data);


    }

}