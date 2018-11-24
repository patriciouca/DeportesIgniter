<?php
class Usuario_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
       $this->load->database();
   }

    public function getTipo($id)
    {

        $this->db->where('id',$id);
        $query = $this->db->get('tipousuario');
        return $query->result()[0]->nombre;
    }
}