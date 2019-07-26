<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_daybook extends CI_Model
{
  //Insertar registro contable
  public function insert_entry($data)
  {
    return $this->db->insert('registro_asiento', $data);
  }
  //Ver los registros contables registrados
  public function get_entries($data)
  {
    $sql = $this->db->get_where('registro_asiento', $data);
    return $sql->result();
  }
  //Ver registro contable registrado
  public function get_entry($data)
  {
    $sql = $this->db->get_where('registro_asiento', $data);
    return $sql->row();
  }
  //Actualizar registro contable
  public function update_entry($data)
  {
    $this->db->where('id', $data['id']);
    return $this->db->update('registro_asiento', $data);
  }
  //Eliminar registro contable
  public function delete_entry($data)
  {
    return $this->db->delete( 'registro_asiento' , $data );
  }
}