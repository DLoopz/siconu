<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model
{
  //Insertar usuario
  public function insert_user($data)
  {
    return $this->db->insert('usuario', $data);
  }
  //Insertar alumno en usuario_grupo
  public function insert_std($data)
  {
    return $this->db->insert('usuario_grupo', $data);
  }
  //Ver los usuarios registrados
  public function get_users($data)
  {
    $sql = $this->db->get_where('usuario', $data);
    return $sql->result();
  }
  //Ver usuario registrado
  public function get_user($data)
  {
    $sql = $this->db->get_where('usuario', $data);
    return $sql->row();
  }
  public function get_info_user($data)
  {
    $sql = $this->db->get_where('grupos_usuarios', $data);
    return $sql->row();
  }
  //obtner ultimo usuario registrado
  public function last_user()
  {
    $this->db->select_max('id_usuario');
    $sql=$this->db->get('usuario');
    return $sql->row();
  }
  //Actualizar usuario
  public function update_user($data)
  {
    $this->db->where('id_usuario', $data['id_usuario']);
    return $this->db->update('usuario', $data);
  }
  //Eliminar usuario
  public function delete_user($data)
  {
    return $this->db->delete( 'usuario' , $data );
  }
   public function delete_users($data)
  {
    $sql = $this->db->truncate('usuario' , $data);
    return $sql;
    
  }

}