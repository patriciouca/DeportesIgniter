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

    public function selectMisTorneos($id_usu){

        $this->db->from('integrante');
        $this->db->where("id_usuario='".$id_usu."'",null,false);
        $query = $this->db->get();
        $resultado=null;
        $i=0;
        foreach ($query->result() as $integrante)
        {
            $equipo=$integrante->id_equipo;

            $this->db->from('equipo');
            $this->db->where("id='".$equipo."'",null,false);
            $query = $this->db->get();

            $resultado[$i]['id']=($query->result())[0]->id_torneo;
            $resultado[$i]['id_equipo']=($query->result())[0]->id;
            $this->db->from('torneo');
            $this->db->where("id='".($query->result())[0]->id_torneo."'",null,false);
            $query = $this->db->get();
            $resultado[$i]['nombre']=($query->result())[0]->nombre;

            $i++;
        }
        return $resultado;
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

    public function insertEncuentro($data){
        $this->db->insert('encuentro', $data);
    }

    public function insertIntegrante($data){
        if($data['nombre']== null || $data['apellidos'] == "")
            throw new Exception("No se puede crear un integrante sin nombre o apellidos");
        $this->db->insert('integrante', $data);
    }

    public function seleccionarNumeros($equipos){
       $cantidad=count($equipos);
       $seleccionados=array();

       for ($i=0;$i<$cantidad;$i++)
        {
            $valor=rand(0,$cantidad-1);

            while(in_array($valor,$seleccionados)!=false)
            {
                $valor=rand(0,$cantidad-1);
            }


            $seleccionados[$i]=$valor;
            if(isset($equipos[$valor]->id))
                $tratado[$i]=$equipos[$valor]->id;
            else
                $tratado[$i]=$equipos[$valor];
        }
        return $tratado;

    }

    public function setGanador($id,$ganador)
    {
        if($id== null || $id == "")
            throw new Exception("No hay id o ganador");

        if($ganador != 1 && $ganador != 2)
            throw new Exception("Solo puede ganar equipo 1 o 2");


        $this->db->set('ganador', $ganador);
        $this->db->where('id', $id);
        $this->db->update('encuentro');

    }

    public function setFinalizado($id)
    {
        $this->db->set('finalizado', 1);
        $this->db->where('id', $id);
        $this->db->update('torneo');

    }

    public function selectEncuentrosW($where=null){

        $this->db->from('encuentro');

        if($where == null){

            $query = $this->db->get();
            return $query->result();

        }

        $this->db->where($where,null,false);
        $query = $this->db->get();
        return $query->result();
    }

    public function selectEncuentros($id_torneo){
        $this->db->from('encuentro');

        $this->db->where("id_torneo='".$id_torneo."'",null,false);
        //$this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function encuentrosPrimeraFase($id_torneo){
        $this->db->from('encuentro');

        $this->db->where("fase=1 and id_torneo='".$id_torneo."'",null,false);
        $query = $this->db->get();

        return count($query->result());
    }

    public function selectMaxFase($id_torneo){
        $this->db->select_max('fase');
        $this->db->where("id_torneo='".$id_torneo."'",null,false);
        $max_fase  = (($this->db->get('encuentro'))->row_array())['fase'];

        return $max_fase;
    }

    public function generarEncuentros($id){

        $this->db->select_max('fase');
        $this->db->where("id_torneo='".$id."'",null,false);
        $max_fase  = (($this->db->get('encuentro'))->row_array())['fase'];


        if(isset($max_fase))
        {
            $this->db->from('encuentro');
            $this->db->where("id_torneo='".$id."'","and fase='".$max_fase."'",false);
            $equiposMal  = $this->db->get()->result();

            $i=0;

            foreach ($equiposMal as $equipo)
            {
                if($equipo->ganador==0)
                {
                    throw new Exception("La fase no ha terminado");
                }
                else if($equipo->ganador==1)
                {
                    $equipos[$i]=$equipo->id_equipo1;
                }
                else if($equipo->ganador==2)
                {
                    $equipos[$i]=$equipo->id_equipo2;
                }

                $i++;
            }

        }
        else{
            $max_fase=0;
            $equipos=$this->selectEquipos("id_torneo='".$id."'");
            if(count($equipos)%2!=0)
                throw new Exception("Tiene que haber numero par de equipos");

            $this->db->set('abierto', 0);
            $this->db->where('id', $id);
            $this->db->update('torneo');


        }

        $emparejamientos=$this->seleccionarNumeros($equipos);
        for ($i=0;$i<count($emparejamientos);$i=$i+2)
        {
            $dataEncuentro=array("id_torneo"=> $id,"id_equipo1"=>$emparejamientos[$i],"id_equipo2"=>$emparejamientos[$i+1],
                "fase"=>$max_fase+1,"ganador"=>0);
            $this->insertEncuentro($dataEncuentro);
        }

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
