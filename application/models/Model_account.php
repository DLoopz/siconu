<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_account extends CI_Model
{
  //Insertar cuentas
  public function insert_account($data)
  {
    return $this->db->insert('catalogo_usuario', $data);
  }
  //Ver las cuentas estandar
  public function get_std_accounts()
  {
    $sql = $this->db->get_where('catalogo_estandar');
    return $sql->result();
  }
  //Ver catalogo registrado
  public function get_catalog($data)
  {
    $sql = $this->db->get_where('catalogo_usuario', $data);
    return $sql->result();
  }
  //Actualizar cuentas
  public function update_group($data)
  {
    $this->db->where('id_grupo', $data['id_grupo']);
    return $this->db->update('grupo', $data);
  }
  //Eliminar cuentas
  public function delete_group($data)
  {
    return $this->db->delete( 'grupo' , $data );
  }
}