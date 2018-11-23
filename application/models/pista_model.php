<?php
class Pista_model extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function getTipoPistas(){
       $query = $this->db->query('pista');
       return $query->result();
   }

}