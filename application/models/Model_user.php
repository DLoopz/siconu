<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model
{
  //Insertar registro contable
  public function insert_user($data)
  {
    return $this->db->insert('usuario', $data);
  }
  //Ver los registros contables registrados
  public function get_users($data)
  {
    $sql = $this->db->get_where('usuario', $data);
    return $sql->result();
  }
  //Ver registro contable registrado
  public function get_user($data)
  {
    $sql = $this->db->get_where('usuario', $data);
    return $sql->row();
  }
  //Actualizar registro contable
  public function update_user($data)
  {
    $this->db->where('id', $data['id']);
    return $this->db->update('usuario', $data);
  }
  //Eliminar registro contable
  public function delete_user($data)
  {
    return $this->db->delete( 'usuario' , $data );
  }
}