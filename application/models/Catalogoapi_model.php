<?php

class Catalogoapi_model extends CI_Model {
    
    public function __construct(){
        Parent::__construct();
    }
    
    public function get($id = null) {
        
        if(!is_null($id)){
            $this->db->select('id, pregunta, imagen, audio');
            $this->db->from('preguntas');
            $this->db->where('nu_modulo', $id);
            $query = $this->db->get();
            
            if ($query->num_rows() > 0){
            return $query->result_array();
            
            }
            
            return false;
            
        }
      
            $this->db->select('id, name');
            $this->db->from('modulos');
            $query = $this->db->get();
      
      if($query->num_rows() > 0){
          return $query->result_array();
      }
      
      return false;
      
    }
    
            public function resultado($data) {
        
       if ($this->db->insert('resultados', $data)){
           
       return true;
        }else{
           return false;
        }
        
        }

        
    public function count($id) {
        //
            $this->db->select('preguntas.nu_modulo as modulo, count(respuestas.valor) as total');
            $this->db->from('resultados');
            $this->db->join('respuestas', 'respuestas.id=resultados.nu_respuesta');
            $this->db->join('preguntas', 'preguntas.id=respuestas.nu_pregunta');
            $this->db->where('respuestas.short', 'Correcto');
            $this->db->where('resultados.nu_user', $id);
            $this->db->group_by('preguntas.nu_modulo');
            
            
            $query = $this->db->get();
      
      if($query->num_rows() > 0){
          return $query->result_array();
      }
      
      return false;
      
    }
}
