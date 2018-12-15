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
    public function selectUsuario($where=null){

        $this->db->from('usuario');

        if($where == null){

            $query = $this->db->get();
            return $query->result();

        }

        $this->db->where($where,null,false);
        $query = $this->db->get();
        return $query->result();

    }


    public function insert($data){

        $this->db->insert('usuario', $data);

    }


}