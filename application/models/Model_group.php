<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_group extends CI_Model
{
  //Insertar registro contable
  public function insert_group($data)
  {
    //se inserta un nuevo grupo
    $this->db->insert('grupo', array('nombre' => $data['nombre']));
    //se obtiene el ultimo id registrado
    $this->db->select_max('id_grupo');
    $sql=$this->db->get('grupo');
    $sql=$sql->row();
    //se inserta en la relacion usuario_grupo
    $fields = array(
      'usuario_id' => $data['usuario_id'],
      'grupo_id' => $sql->id_grupo
    );
    return $this->db->insert('usuario_grupo', $fields);
  }
  //Ver los registros contables registrados
  public function get_groups($data)
  {
    $sql = $this->db->get_where('grupos_usuarios', $data);
    return $sql->result();
  }
  //Ver registro contable registrado
  public function get_group($data)
  {
    $sql = $this->db->get_where('grupo', $data);
    return $sql->row();
  }
  //Actualizar registro contable
  public function update_group($data)
  {
    $this->db->where('id_grupo', $data['id_grupo']);
    return $this->db->update('grupo', $data);
  }
  //Eliminar registro contable
  public function delete_group($data)
  {
    return $this->db->delete( 'grupo' , $data );
  }

  //eliminar grupos
  public function delete_groups()
  {
    $this->db->where('id_grupo>0');
    $sql=$this->db->delete('grupo');

    $this->db->where('rol=3');
    $sql=$this->db->delete('usuario');

    return $sql;
  }


}
