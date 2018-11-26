<?php
class Alquiler_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
       $this->load->database();
   }
    public function selectAlquiler($where=null){

        $this->db->from('alquiler');

        if($where == null){

            $query = $this->db->get();
            return $query->result();

        }

        $this->db->where($where,null,false);
        $query = $this->db->get();
        return $query->result();

    }

    public function insertAlquiler($data){
        $this->db->insert('alquiler', $data);


    }



}